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
        'address', 'owner'
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
