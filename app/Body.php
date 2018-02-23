<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Body extends Model
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
     * Fetch the Grape's with this Body
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function grapes()
    {
        return $this->hasMany(Grape::class);
    }
}
