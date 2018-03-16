<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
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

    /**
     * The relations to be eager loaded every time a user is fetched from the database.
     *
     * @var array
     */
    protected $with = [
        'region'
    ];

    /************************* Relations ******************************/

    /**
     * Fetch the City's Region.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Fetch the City's Addresses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    /************************* Accessors ******************************/

    /**
     * Get the City's name.
     *
     * @param string $name
     * @return string
     */
    public function getNameAttribute(string $name): string
    {
        return trim(preg_replace('/\s+/', ' ', ucwords($name)));
    }

    /**
     * Fetch the City's region name.
     *
     * @return string
     */
    public function getRegionNameAttribute(): string
    {
        return $this->region->name;
    }

    /**
     * Fetch the City's country.
     *
     * @return Country
     */
    public function getCountryAttribute(): Country
    {
        return $this->region->country;
    }

    /**
     * Fetch the City's country name.
     *
     * @return Country
     */
    public function getCountryNameAttribute(): string
    {
        return $this->region->countryName;
    }

    /**
     * Get the City's full name, including the Country.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "$this->name, $this->regionName, $this->countryName";
    }

    /************************* Mutators ******************************/

    /**
     * Set the City's name.
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
