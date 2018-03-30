<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Spatie\MediaLibrary\File;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property Collection addresses
 * @property Address main_address
 * @property Address shipping Shipping Address
 */
class User extends Authenticatable implements HasMedia
{
    use Notifiable, HasRoles, HasMediaTrait, HasSlug;

    /************************* Properties ******************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'username', 'email', 'password', 'description', 'rating_count',
        'rating_visibility_id', 'shipping_address_id', 'newsletter', 'email_offers', 'rank',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The relations to be eager loaded every time a user is fetched from the database.
     *
     * @var array
     */
    protected $with = ['wishlist', 'rating', 'addresses'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'newsletter' => 'boolean',
        'email_offers' => 'boolean',
    ];

    /**
     * @param Media|null $media
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumbnail')
            ->width(30)
            ->height(30);
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('avatar')
            ->useDisk('media_users_avatars')
            ->acceptsFile(function (File $file) {
                return collect([
                    'image/jpg',
                    'image/jpeg',
                    'image/png'
                ])->contains($file->mimeType);
            })
            ->singleFile();
    }

    /************************* Relations ******************************/

    /**
     * Fetch the User's shipping address instance.
     *
     * @return BelongsTo
     */
    public function shipping(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'shipping_address_id');
    }

    /**
     * Fetch all User's known addresses.
     *
     * @return MorphMany
     */
    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    /**
     * Fetch User's Rating Visibility.
     *
     * @return BelongsTo
     */
    public function rating(): BelongsTo
    {
        return $this->belongsTo(RatingVisibility::class, 'rating_visibility_id');
    }

    /**
     * Fetch User's wines wishlist.
     *
     * @return BelongsToMany
     */
    public function wishlist(): BelongsToMany
    {
        return $this->belongsToMany(Wine::class)->withTimestamps();
    }

    /**
     * Fetch User's Winery's that he owns.
     *
     * @return HasMany
     */
    public function wineries(): HasMany
    {
        return $this->hasMany(Winery::class, 'owner_id', 'id');
    }

    /**
     * Fetch User's Winery's where he works.
     *
     * @return BelongsToMany
     */
    public function employedAt(): BelongsToMany
    {
        return $this->belongsToMany(Winery::class, 'user_winery', 'user_id', 'winery_id')
            ->withTimestamps();
    }

    /**
     * Fetch the User's wine ratings.
     *
     * @return BelongsToMany
     */
    public function wineRatings(): BelongsToMany
    {
        return $this->belongsToMany(Wine::class, 'wine_ratings', 'user_id', 'wine_id')
            ->withPivot('rate')
            ->withTimestamps();
    }

    /************************* Accessors ******************************/

    /**
     * Fetch User's first name.
     *
     * @param  string $first_name
     * @return string
     */
    public function getFirstNameAttribute(string $first_name): string
    {
        return trim(preg_replace('/\s+/', ' ', ucwords($first_name)));
    }

    /**
     * Fetch User's last name.
     *
     * @param  string $last_name
     * @return string
     */
    public function getLastNameAttribute(string $last_name): string
    {
        return trim(preg_replace('/\s+/', ' ', ucwords($last_name)));
    }

    /**
     * Fetch User's full name.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "$this->first_name $this->last_name";
    }

    /**
     * Fetch User's email.
     *
     * @param string $email
     * @return string
     */
    public function getEmailAttribute(string $email): string
    {
        return trim(preg_replace('/\s+/', ' ', strtolower($email)));
    }

    /**
     * Fetch User's country name.
     *
     * @return string
     */
    public function getCountryNameAttribute(): string
    {
        return $this->main_address
            ->country
            ->name;
    }

    /**
     * Fetch User's main primary address
     *
     * @return Address
     */
    public function getMainAddressAttribute(): Address
    {
        return $this->addresses->where('is_primary', true)->first();
    }

    /**
     * Fetch User's full shipping address.
     *
     * @return string
     */
    public function getShippingAddressAttribute(): string
    {
        return $this->shipping->full_address;
    }

    /**
     * Fetch User's Avatar.
     *
     * @return string
     */
    public function getAvatarAttribute(): string
    {
        return $this->getMedia('avatar')->first()->getUrl();
    }

    /**
     * Fetch User's Thumbnail Avatar.
     *
     * @return string
     */
    public function getThumbnailAvatarAttribute(): string
    {
        return $this->getMedia('avatar')->first()->getUrl('thumbnail');
    }

    /************************* Mutators ******************************/

    /**
     * Set User's first name.
     *
     * @param  string $first_name
     * @return void
     */
    public function setFirstNameAttribute(string $first_name): void
    {
        $this->attributes['first_name'] = trim(preg_replace('/\s+/', ' ', strtolower($first_name)));
    }

    /**
     * Set User's last name.
     *
     * @param  string $last_name
     * @return void
     */
    public function setLastNameAttribute(string $last_name): void
    {
        $this->attributes['last_name'] = trim(preg_replace('/\s+/', ' ', strtolower($last_name)));
    }

    /**
     * Set User's email.
     *
     * @param string $email
     * @return void
     */
    public function setEmailAttribute(string $email): void
    {
        $this->attributes['email'] = trim(preg_replace('/\s+/', ' ', strtolower($email)));
    }

    /**
     * Set User's password with an hash representation.
     *
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /************************* Functions ******************************/

    /**
     * Attaches the User to a given Winery.
     *
     * @param Winery|int $winery
     */
    public function employTo($winery)
    {
        $this->employedAt()->attach($winery);
    }

    /**
     * Detaches the User from a given Winery.
     *
     * @param Winery|int $winery
     */
    public function quitFrom($winery)
    {
        $this->employedAt()->detach($winery);
    }

    /************************* Functions ******************************/

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'username';
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['first_name', 'last_name'])
            ->usingSeparator('_')
            ->saveSlugsTo('username');
    }
}
