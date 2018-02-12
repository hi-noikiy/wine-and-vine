<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The relations to be eager loaded every time a user is fetched from the database
     *
     * @var array
     */
    protected $with = [
        'city'
    ];

    protected $casts = [
        'postcode' => 'integer'
    ];

    /**
     * Fetch the City's Region
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Fetch the City's Addresses
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Set the Addresses name
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
     * Get the Addresses name
     *
     * @param string $name
     * @return string
     */
    public function getNameAttribute(string $name)
    {
        return trim(preg_replace('/\s+/', ' ', ucwords($name)));
    }

    /**
     * Get the City's full name, including the Country
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->street_name}, {$this->city->postcode}-{$this->postcode} {$this->city->name}, {$this->city->region->name}, {$this->city->region->country->name}";
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}
