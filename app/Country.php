<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /************************* Properties ******************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /************************* Relations ******************************/

    /**
     * Fetch Country's Regions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function regions()
    {
        return $this->hasMany(Region::class);
    }

    /************************* Accessors ******************************/

    /**
     * Get the Country's name.
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
     * Set the Country's name.
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
