<?php

namespace App;

use Illuminate\Database\Eloquent\{
    Model, Relations\HasMany
};

class Body extends Model
{
    /************************* Properties ******************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image'
    ];

    /************************* Relations ******************************/

    /**
     * Fetch the Grape's with this Body
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wines(): HasMany
    {
        return $this->hasMany(Wine::class);
    }
}
