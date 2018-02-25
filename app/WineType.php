<?php

namespace App;

use Illuminate\Database\Eloquent\{
    Model, Relations\HasMany
};

class WineType extends Model
{
    /************************* Properties ******************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /************************* Relations ******************************/

    /**
     * Fetch WineType's wines
     *
     * @return HasMany
     */
    public function wines(): HasMany
    {
        return $this->hasMany(Wine::class);
    }
}
