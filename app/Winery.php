<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Winery extends Model
{
    /**
     *
     *
     * @var array
     */
    protected $fillable = [
        'name', 'owner_id'
    ];

    /**
     *
     *
     * @var array
     */
    protected $with = [
        'address',
    ];

    /**
     * Fetch Winery's address
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    /**
     * Fetch the Winery's wines
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wines()
    {
        return $this->hasMany(Wine::class);
    }

    /**
     * Fetch the Winery's owner
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Fetch the Winery's employees
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function employees()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Returns the Winery's city
     *
     * @return City
     */
    public function city()
    {
        return $this->address->city->name;
    }

    /**
     * Returns the Winery's region
     *
     * @return City
     */
    public function region()
    {
        return $this->address->city->region->name;
    }

    /**
     * Returns the Winery's country
     *
     * @return City
     */
    public function country()
    {
        return $this->address->city->region->country->name;
    }

    /**
     * Attaches the Winery and a given User to the user_winery pivot table
     *
     * @param $user
     */
    public function employ($user)
    {
        $this->employees()->attach($user);
    }

    /**
     * Detaches the Winery and a given User to the user_winery pivot table
     *
     * @param $user
     */
    public function fire($user)
    {
        $this->employees()->detach($user);
    }

    /**
     * Set the Winery's name
     *
     * @param string $name
     */
    public function setNameAttribute(string $name)
    {
        $this->attributes['name'] = trim(preg_replace('/\s+/', ' ', strtolower($name)));
    }

    /**
     * Get the Winery's name
     *
     * @param string $name
     * @return string
     */
    public function getNameAttribute(string $name)
    {
        return trim(preg_replace('/\s+/', ' ', ucwords($name)));
    }
}
