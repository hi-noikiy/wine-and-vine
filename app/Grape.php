<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grape extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'short_description', 'description',
    ];

    /**
     * Returns the Wines's where this Grape is
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function wines()
    {
        return $this->belongsToMany(Wine::class);
    }
}