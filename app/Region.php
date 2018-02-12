<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'country_id', 'name'
    ];

    /**
     * The relations to be eager loaded every time a user is fetched from the database
     *
     * @var array
     */
    protected $with = [
        'country'
    ];

    /**
     * Fetch the Region's Country
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Fetch the Region's Cities
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    /**
     * Set the Region's name
     *
     * @param string $name
     * @return void
     */
    public function setNameAttribute(string $name)
    {
        $this->attributes['name'] = trim(
            preg_replace('/\s+/', ' ', strtolower($name))
        );
    }

    /**
     * Get the Region's name
     *
     * @param string $name
     * @return string
     */
    public function getNameAttribute(string $name)
    {
        return trim(preg_replace('/\s+/', ' ', ucwords($name)));
    }

    /**
     * Get the Region's full name, including the Country
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->name}, {$this->country->name}";
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}
