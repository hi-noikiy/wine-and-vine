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

    // TODO: Add some accessor's and mutator's
}