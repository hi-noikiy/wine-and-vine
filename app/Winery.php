<?php

namespace App;

use Spatie\MediaLibrary\File;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Winery extends Model implements HasMedia
{
    use HasMediaTrait, HasSlug;
    /************************* Properties ******************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone_number', 'mobile_number', 'user_id'
    ];

    /**
     * The relations to be eager loaded every time a user is fetched from the database.
     *
     * @var array
     */
    protected $with = [
        'address', 'region',
    ];

    protected $appends = ['country'];

    /**
     * @param Media|null $media
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumbnail')
            ->width(150)
            ->height(150)
            ->sharpen(10);
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('cover')
            ->useDisk('media_wineries_images')
            ->acceptsFile(function (File $file) {
                return collect([
                    'image/jpg',
                    'image/jpeg',
                    'image/png'
                ])->contains($file->mimeType);
            })
            ->singleFile();

        $this->addMediaCollection('images')
            ->useDisk('media_wineries_images')
            ->acceptsFile(function (File $file) {
                return collect([
                    'image/jpg',
                    'image/jpeg',
                    'image/png'
                ])->contains($file->mimeType);
            });
    }

    /************************* Relations ******************************/

    /**
     * Fetch the Winery's wines.
     *
     * @return HasMany
     */
    public function wines(): HasMany
    {
        return $this->hasMany(Wine::class);
    }

    /**
     * Fetch Winery's owner.
     *
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    /**
     * Fetch Winery's employees.
     *
     * @return BelongsToMany
     */
    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_winery', 'winery_id', 'user_id')
            ->withTimestamps();
    }

    /**
     * Fetch Winery's region.
     *
     * @return BelongsTo
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Fetch Winery's address.
     *
     * @return MorphOne
     */
    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    /************************* Accessors ******************************/

    /**
     * Fetch Winery's name.
     *
     * @param string $name
     * @return string
     */
    public function getNameAttribute(string $name): string
    {
        return trim(preg_replace('/\s+/', ' ', ucwords($name)));
    }

    /**
     * Fetch Winery's email.
     *
     * @param string $email
     * @return string
     */
    public function getEmailAttribute(string $email): string
    {
        return trim(preg_replace('/\s+/', ' ', strtolower($email)));
    }

    /**
     * Fetch Winery's phone number.
     *
     * @param string $phone
     * @return string
     */
    public function getPhoneNumberAttribute(string $phone): string
    {
        return trim(preg_replace('/\s+/', ' ', $phone));
    }

    /**
     * Fetch Winery's mobile number.
     *
     * @param string $mobile
     * @return string
     */
    public function getMobileNumberAttribute(string $mobile): string
    {
        return trim(preg_replace('/\s+/', ' ', $mobile));
    }

    /**
     * Fetch Winery's address name.
     *
     * @return string
     */
    public function getAddressNameAttribute(): string
    {
        return $this->address->street_name;
    }

    /**
     * Fetch Winery's region name.
     *
     * @return string
     */
    public function getRegionNameAttribute(): string
    {
        return $this->region->name;
    }

    /**
     * Fetch Winery's country.
     *
     * @return Country
     */
    public function getCountryAttribute(): Country
    {
        return $this->address->country;
    }

    /**
     * Fetch Winery's country name.
     *
     * @return string
     */
    public function getCountryNameAttribute(): string
    {
        return $this->address->country->name;
    }

    /**
     * Fetch the Winery's full address.
     *
     * @return string
     */
    public function getFullAddressAttribute(): string
    {
        return $this->address->fullAddress;
    }

    /************************* Mutators ******************************/

    /**
     * Set the Winery's name.
     *
     * @param string $name
     */
    public function setNameAttribute(string $name): void
    {
        $this->attributes['name'] = trim(preg_replace('/\s+/', ' ', strtolower($name)));
    }

    /**
     * Set the Winery's email.
     *
     * @param string $email
     */
    public function setEmailAttribute(string $email): void
    {
        $this->attributes['email'] = trim(preg_replace('/\s+/', ' ', strtolower($email)));
    }

    /**
     * Set the Winery's phone number.
     *
     * @param string $phone
     */
    public function setPhoneNumberAttribute(string $phone): void
    {
        $this->attributes['phone_number'] = trim(preg_replace('/\s+/', ' ', $phone));
    }

    /**
     * Set the Winery's mobile number.
     *
     * @param string $mobile
     */
    public function setMobileNumberAttribute(string $mobile): void
    {
        $this->attributes['mobile_number'] = trim(preg_replace('/\s+/', ' ', $mobile));
    }

    /************************* Functions ******************************/

    /**
     * Attaches the Winery to a given User.
     *
     * @param User|int $user
     * @return void
     */
    public function employ($user): void
    {
        $this->employees()->attach($user);
    }

    /**
     * Detaches the Winery from a given User.
     *
     * @param User|int $user
     * @return void
     */
    public function fire($user): void
    {
        $this->employees()->detach($user);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
