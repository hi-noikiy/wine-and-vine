<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    public function wines() : HasMany
    {
        return $this->hasMany(Wine::class);
    }

    public function setNameAttribute(string $name) : void
    {
        $this->attributes['name'] = trim(preg_replace('/\s+/', ' ', strtolower($name)));
    }

    /**
     * @param string $name
     * @return string
     */
    public function getNameAttribute(string $name) : string
    {
        return trim(preg_replace('/\s+/', ' ', ucwords($name)));
    }
}
