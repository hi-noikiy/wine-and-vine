<?php

namespace App;

use Illuminate\Database\Eloquent\{
    Model, Relations\HasMany
};

class Color extends Model
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
     * Fetch the Grape's with this Color
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wines(): HasMany
    {
        return $this->hasMany(Wine::class);
    }

    /************************* Accessors ******************************/

    /**
     * Fetch Color's name
     *
     * @param string $name
     * @return string
     */
    public function getNameAttribute(string $name) : string
    {
        return trim(preg_replace('/\s+/', ' ', ucwords($name)));
    }

    /************************* Mutators ******************************/

    /**
     * Set the Color's name
     *
     * @param string $name
     * @return void
     */
    public function setNameAttribute(string $name) : void
    {
        $this->attributes['name'] = trim(preg_replace('/\s+/', ' ', strtolower($name)));
    }
}
