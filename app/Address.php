<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
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
        'city'
    ];

    protected $casts = [
        'postcode' => 'integer'
    ];

    /************************* Relations ******************************/

    /**
     * Get all of the owning addressable models.
     *
     * @return MorphTo
     */
    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Fetch the Address's city relation.
     *
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /************************* Accessors ******************************/

    /**
     * Fetch the Address's city name.
     *
     * @return string
     */
    public function getCityNameAttribute(): string
    {
        return $this->city->name;
    }

    /**
     * Fetch the Address's region.
     *
     * @return Region
     */
    public function getRegionAttribute(): Region
    {
        return $this->city->region;
    }

    /**
     * Fetch the Address's region name.
     *
     * @return string
     */
    public function getRegionNameAttribute(): string
    {
        return $this->city->region->name;
    }

    /**
     * Fetch the Address's country.
     *
     * @return Country
     */
    public function getCountryAttribute(): Country
    {
        return $this->city->country;
    }

    /**
     * Fetch the Address's country name.
     *
     * @return string
     */
    public function getCountryNameAttribute(): string
    {
        return $this->city->country->name;
    }

    /**
     * Get the Address's name.
     *
     * @param string $type
     * @return string
     */
    public function getTypeAttribute(string $type): string
    {
        return trim(preg_replace('/\s+/', ' ', ucwords($type)));
    }

    /**
     * Get the Address's street name.
     *
     * @param string $streetName
     * @return string
     */
    public function getStreetNameAttribute(string $streetName): string
    {
        return trim(preg_replace('/\s+/', ' ', ucwords($streetName)));
    }

    /**
     * Get the Address's full address.
     *
     * @return string
     */
    public function getFullAddressAttribute(): string
    {
        return "$this->street_name, $this->postcode $this->cityName, $this->regionName, $this->countryName";
    }

    /************************* Mutators ******************************/

    /**
     * Set the Address's name.
     *
     * @param string $type
     * @return void
     */
    public function setTypeAttribute(string $type): void
    {
        $this->attributes['type'] = trim(
            preg_replace('/\s+/', ' ', strtolower($type))
        );
    }

    /**
     * Set the Address's street name.
     *
     * @param string $streetName
     * @return void
     */
    public function setStreetNameAttribute(string $streetName): void
    {
        $this->attributes['street_name'] = trim(preg_replace('/\s+/', ' ', strtolower($streetName)));
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
