<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wine extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'style', 'description', 'year', 'price', 'quantity_in_stock',
        'rating_count', 'rating_sum', 'region', 'country', 'food_pairing'
    ];

    protected $with = [
        'grapes', 'wishlists', 'winery'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Returns the Wine's winery
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function winery()
    {
        return $this->belongsTo(Winery::class);
    }

    /**
     * Returns the Wine's grapes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function grapes()
    {
        return $this->BelongsToMany(Grape::class);
    }

    /**
     * Returns the User's that wishes this particular wine
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function wishlists()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * Set the wine's name
     *
     * @param string $name
     * @return void
     */
    public function setNameAttribute(string $name): void
    {
        $this->attributes['name'] = trim(preg_replace('/\s+/', ' ', strtolower($name)));
    }

    /**
     * Fetch the wine's name
     *
     * @param string $name
     * @return string
     */
    public function getNameAttribute(string $name): string
    {
        return trim(preg_replace('/\s+/', ' ', ucwords($name)));
    }

    /**
     * Set the wine's type
     *
     * @param string $type
     * @return void
     */
    public function setTypeAttribute(string $type): void
    {
        $this->attributes['type'] = trim(preg_replace('/\s+/', ' ', strtolower($type)));
    }

    /**
     * Fetch the wine's type
     *
     * @param string $type
     * @return string
     */
    public function getTypeAttribute(string $type): string
    {
        return trim(preg_replace('/\s+/', ' ', ucwords($type)));
    }

    /**
     * Set the wine's style
     *
     * @param string $style
     * @return void
     */
    public function setStyleAttribute(string $style): void
    {
        $this->attributes['style'] = trim(preg_replace('/\s+/', ' ', strtolower($style)));
    }

    /**
     * Fetch the wine's style
     *
     * @param string $style
     * @return string
     */
    public function getStyleAttribute(string $style): string
    {
        return trim(preg_replace('/\s+/', ' ', ucwords($style)));
    }

    /**
     * Set the wine's description
     *
     * @param string $description
     * @return void
     */
    public function setDescriptionAttribute(string $description): void
    {
        $this->attributes['description'] = trim(preg_replace('/\s+/', ' ', $description));
    }

    /**
     * Fetch the wine's description
     *
     * @param string $description
     * @return string
     */
    public function getDescriptionAttribute(string $description): string
    {
        return trim(preg_replace('/\s+/', ' ', $description));
    }
}