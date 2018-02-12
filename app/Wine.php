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
     * Returns the users that wishes this particular wine
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function onWishList()
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
        $this->attributes['name'] = strtolower($name);
    }

    /**
     * Fetch the wine's name
     *
     * @param string $name
     * @return string
     */
    public function getNameAttribute(string $name): string
    {
        return ucwords($name);
    }

    /**
     * Set the wine's type
     *
     * @param string $type
     * @return void
     */
    public function setTypeAttribute(string $type): void
    {
        $this->attributes['type'] = strtolower($type);
    }

    /**
     * Fetch the wine's type
     *
     * @param string $type
     * @return string
     */
    public function getTypeAttribute(string $type): string
    {
        return ucwords($type);
    }
}