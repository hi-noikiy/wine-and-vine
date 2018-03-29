<?php

namespace App;

use Spatie\MediaLibrary\File;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Wine extends Model implements HasMedia
{
    use HasMediaTrait, HasSlug;

    /************************* Properties ******************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'year', 'price', 'short_description', 'description', 'quantity_in_stock', 'rating_count', 'rating_sum',
        'temperature', 'alcohol', 'wine_acidity_id', 'wine_body_id', 'wine_color_id', 'wine_type_id', 'winery_id',
    ];

    /**
     * The relations to be eager loaded every time a wine is fetched from the database.
     *
     * @var array
     */
    protected $with = [
        'acidity', 'body', 'castes', 'color', 'currency', 'denomination', 'food_pairing', 'type', 'winery', //'wishlists'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @param Media|null $media
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumbnail')
            ->width(300)
            ->sharpen(10);
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('cover')
            ->useDisk('media_wines_images')
            ->acceptsFile(function (File $file) {
                return collect([
                    'image/jpg',
                    'image/jpeg',
                    'image/png'
                ])->contains($file->mimeType);
            })
            ->singleFile();

        $this->addMediaCollection('images')
            ->useDisk('media_wines_images')
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
     * Fetch Wine's acidity.
     *
     * @return BelongsTo
     */
    public function acidity(): BelongsTo
    {
        return $this->belongsTo(WineAcidity::class, 'wine_acidity_id');
    }

    /**
     * Fetch Wine's body.
     *
     * @return BelongsTo
     */
    public function body(): BelongsTo
    {
        return $this->belongsTo(WineBody::class, 'wine_body_id');
    }

    /**
     * Fetch Wine's castes.
     *
     * @return BelongsToMany
     */
    public function castes(): BelongsToMany
    {
        return $this->BelongsToMany(Grape::class)
            ->withTimestamps();
    }

    /**
     * Fetch Wine's color.
     *
     * @return BelongsTo
     */
    public function color(): BelongsTo
    {
        return $this->belongsTo(WineColor::class, 'wine_color_id');
    }

    /**
     * Fetch Wine's currency.
     *
     * @return BelongsTo
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    /**
     * Fetch Wine's origin denomination.
     *
     * @return BelongsTo
     */
    public function denomination(): BelongsTo
    {
        return $this->belongsTo(WineOriginDenomination::class, 'wine_origin_denomination_id');
    }

    /**
     * Fetch Wine's food pairings.
     *
     * @return BelongsToMany
     */
    public function food_pairing(): BelongsToMany
    {
        return $this->belongsToMany(FoodPair::class);
    }

    /**
     * Fetch Wine's type.
     *
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(WineType::class, 'wine_type_id');
    }

    /**
     * Fetch Wine's winery.
     *
     * @return BelongsTo
     */
    public function winery(): BelongsTo
    {
        return $this->belongsTo(Winery::class);
    }

    /**
     * Fetch Wine's wishlists.
     *
     * @return BelongsToMany
     */
    public function wishlists(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * Fetch the Wine's ratings
     *
     * @return BelongsToMany
     */
    public function ratings(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'wine_ratings', 'wine_id', 'user_id')
            ->withPivot('rate')
            ->withTimestamps();
    }

    /************************* Accessors ******************************/

    /**
     * Fetch Wine's name.
     *
     * @param string $name
     * @return string
     */
    public function getNameAttribute(string $name): string
    {
        return trim(preg_replace('/\s+/', ' ', ucwords($name)));
    }

    /**
     * Fetch Wine's description.
     *
     * @param string $description
     * @return string
     */
    public function getDescriptionAttribute(string $description): string
    {
        return trim(preg_replace('/\s+/', ' ', $description));
    }

    /**
     * @param $price
     * @return string
     */
//    public function getPriceAttribute($price): string
//    {
//        if (Auth::check()) {
//            $currency = Auth::user()->country->currencies->first();
//        } else {
//            $currency = Currency::where('short_name', 'USD')->first();
//        }
//
//        if (array_search('symbol', explode('-', $currency->format)) === 0)
//            return "$currency->symbol $price";
//        return "$price $currency->symbol";
//    }

    /**
     * Fetch Wine's region.
     *
     * @return Region
     */
    public function getRegionAttribute(): Region
    {
        return $this->winery->region;
    }

    /**
     * Fetch Wine's region name.
     *
     * @return string
     */
    public function getRegionNameAttribute(): string
    {
        return $this->region->name;
    }

    /**
     * Fetch Wine's country.
     *
     * @return Country
     */
    public function getCountryAttribute(): Country
    {
        return $this->winery->country;
    }

    /**
     * Fetch Wine's country name.
     *
     * @return string
     */
    public function getCountryNameAttribute(): string
    {
        return $this->country->name;
    }

    /**
     * Fetch Wine's rating.
     *
     * @return float
     */
    public function getRatingAttribute(): float
    {
        return round($this->rating_sum / $this->rating_count, 2);
    }

    /**
     * Fetch Wine's Avatar.
     *
     * @return string
     */
    public function getCoverAttribute(): string
    {
        return $this->getMedia('cover')->first()->getUrl();
    }

    /**
     * Fetch Wine's Thumbnail Avatar.
     *
     * @return string
     */
    public function getThumbnailCoverAttribute(): string
    {
        return $this->getMedia('cover')->first()->getUrl('thumbnail');
    }

    /************************* Mutators ******************************/

    /**
     * Set the Wine's name.
     *
     * @param string $name
     * @return void
     */
    public function setNameAttribute(string $name): void
    {
        $this->attributes['name'] = trim(preg_replace('/\s+/', ' ', strtolower($name)));
    }

    /**
     * Set the Wine's description.
     *
     * @param string $description
     * @return void
     */
    public function setDescriptionAttribute(string $description): void
    {
        $this->attributes['description'] = trim(preg_replace('/\s+/', ' ', $description));
    }

    /************************* Functions ******************************/

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
