<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string addressable_type
 * @property mixed addressable
 * @property int addressable_id
 * @property Country country
 * @property string full_address
 */
class Address extends Model
{
    /************************* Properties ******************************/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'street_name', 'country_id', 'addressable_id', 'addressable_type', 'type', 'postcode', 'city', 'is_primary'
    ];

    /**
     * The relations to be eager loaded every time a user is fetched from the database.
     *
     * @var array
     */
    protected $with = [
        'country'
    ];

    protected $casts = [
        'is_primary' => 'boolean'
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
     * Fetch the Address's country relation.
     *
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /************************* Accessors ******************************/

    /**
     * Fetch the Address's country name.
     *
     * @return string
     */
    public function getCountryNameAttribute(): string
    {
        return $this->country->name;
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
        return "$this->street_name, $this->postcode $this->city, $this->countryName";
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
