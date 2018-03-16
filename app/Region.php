<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Region extends Model
{
    /************************* Properties ******************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'country_id'
    ];

    /**
     * The relations to be eager loaded every time a user is fetched from the database.
     *
     * @var array
     */
    protected $with = [
        'country'
    ];

    /************************* Relations ******************************/

    /**
     * Fetch the Region's Country.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Fetch the Region's Cities.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    /************************* Accessors ******************************/

    /**
     * Get the Region's name.
     *
     * @param string $name
     * @return string
     */
    public function getNameAttribute(string $name): string
    {
        return trim(preg_replace('/\s+/', ' ', ucwords($name)));
    }

    /**
     * Fetch the Region's country name.
     *
     * @return string
     */
    public function getCountryNameAttribute(): string
    {
        return $this->country->name;
    }

    /**
     * Get the Region's full name, including the Country.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "$this->name, $this->countryName";
    }

    /************************* Mutators ******************************/

    /**
     * Sets the Region's name.
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
