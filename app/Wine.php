<?php

namespace App;

use Illuminate\Database\Eloquent\{
    Model, Relations\BelongsTo, Relations\BelongsToMany
};

class   Wine extends Model
{
    /************************* Properties ******************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'year', 'price', 'description', 'quantity_in_stock', 'rating_count', 'rating_sum',
        'temperature', 'alcohol', 'wine_acidity_id', 'wine_body_id', 'wine_color_id', 'wine_type_id', 'food_pairing_id',
        'winery_id',
    ];

    /**
     * The relations to be eager loaded every time a wine is fetched from the database
     *
     * @var array
     */
    protected $with = ['acidity', 'body', 'castes', 'color', 'denomination', 'food_pairing', 'type', 'winery', //'wishlists'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /************************* Relations ******************************/

    /**
     * Fetch Wine's acidity
     *
     * @return BelongsTo
     */
    public function acidity(): BelongsTo
    {
        return $this->belongsTo(WineAcidity::class, 'wine_acidity_id');
    }

    /**
     * Fetch Wine's body
     *
     * @return BelongsTo
     */
    public function body(): BelongsTo
    {
        return $this->belongsTo(WineBody::class, 'wine_body_id');
    }

    /**
     * Fetch Wine's castes
     *
     * @return BelongsToMany
     */
    public function castes(): BelongsToMany
    {
        return $this->BelongsToMany(Grape::class);
    }

    /**
     * Fetch Wine's color
     *
     * @return BelongsTo
     */
    public function color(): BelongsTo
    {
        return $this->belongsTo(WineColor::class, 'wine_color_id');
    }

    /**
     * Fetch Wine's origin denomination
     *
     * @return BelongsTo
     */
    public function denomination(): BelongsTo
    {
        return $this->belongsTo(WineOriginDenomination::class, 'wine_origin_denomination_id');
    }

    /**
     * Fetch Wine's food pairings
     *
     * @return BelongsToMany
     */
    public function food_pairing(): BelongsToMany
    {
        return $this->belongsToMany(FoodPair::class);
    }

    /**
     * Fetch Wine's type
     *
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(WineType::class, 'wine_type_id');
    }

    /**
     * Fetch Wine's winery
     *
     * @return BelongsTo
     */
    public function winery(): BelongsTo
    {
        return $this->belongsTo(Winery::class);
    }

    /**
     * Fetch Wine's wishlists
     *
     * @return BelongsToMany
     */
    public function wishlists(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /************************* Accessors ******************************/

    /**
     * Fetch Wine's name
     *
     * @param string $name
     * @return string
     */
    public function getNameAttribute(string $name): string
    {
        return trim(preg_replace('/\s+/', ' ', ucwords($name)));
    }

    /**
     * Fetch Wine's description
     *
     * @param string $description
     * @return string
     */
    public function getDescriptionAttribute(string $description): string
    {
        return trim(preg_replace('/\s+/', ' ', $description));
    }

    /**
     * Fetch Wine's region
     *
     * @return Region
     */
    public function getRegionAttribute(): Region
    {
        return $this->winery->region;
    }

    /**
     * Fetch Wine's region name
     *
     * @return string
     */
    public function getRegionNameAttribute(): string
    {
        return $this->region->name;
    }

    /**
     * Fetch Wine's country
     *
     * @return Country
     */
    public function getCountryAttribute(): Country
    {
        return $this->winery->country;
    }

    /**
     * Fetch Wine's country name
     *
     * @return string
     */
    public function getCountryNameAttribute(): string
    {
        return $this->country->name;
    }

    /**
     * Fetch Wine's rating
     *
     * @return float
     */
    public function getRatingAttribute() : float
    {
        return $this->rating_sum / $this->rating_count;
    }

    /************************* Mutators ******************************/

    /**
     * Set the Wine's name
     *
     * @param string $name
     * @return void
     */
    public function setNameAttribute(string $name): void
    {
        $this->attributes['name'] = trim(preg_replace('/\s+/', ' ', strtolower($name)));
    }

    /**
     * Set the Wine's description
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
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }
}