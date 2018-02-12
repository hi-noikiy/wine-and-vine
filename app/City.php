<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
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
        'region'
    ];

    protected $casts = [
        'postcode' => 'integer'
    ];

    /**
     * Fetch the City's Region
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Fetch the City's Addresses
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    /**
     * Set the City's name
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
     * Get the City's name
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
        return "{$this->name}, {$this->region->name}, {$this->region->country->name}";
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}
