<?php

namespace App;

use Illuminate\Database\Eloquent\{
    Model, Relations\BelongsToMany
};

class Grape extends Model
{
    /************************* Properties ******************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'short_description', 'description'
    ];

    /************************* Relations ******************************/

    /**
     * Returns the Wines's where this Grape is
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function wines(): BelongsToMany
    {
        return $this->belongsToMany(Wine::class);
    }

    /************************* Accessors ******************************/

    /**
     * Fetch the Grape's name
     *
     * @param string $name
     * @return string
     */
    public function getNameAttribute(string $name): string
    {
        return trim(preg_replace('/\s+/', ' ', ucwords($name)));
    }

    /************************* Mutators ******************************/

    /**
     * Sets the Grape's name
     *
     * @param string $name
     * @return void
     */
    public function setNameAttribute(string $name): void
    {
        $this->attributes['name'] = trim(preg_replace('/\s+/', ' ', strtolower($name)));
    }

    /************************* Functions ******************************/

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }
}