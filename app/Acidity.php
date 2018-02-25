<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acidity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image'
    ];

    /**
     * Fetch the Grape's with this Acidity
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wines()
    {
        return $this->hasMany(Wine::class);
    }
}
