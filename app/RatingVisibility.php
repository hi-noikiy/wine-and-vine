<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RatingVisibility extends Model
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
     * Fetch all user's associated with a rating visibility
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Gets the rating visibility option
     *
     * @param string $name
     * @return void
     */
    public function setNameAttribute(string $name)
    {
        $this->attributes['name'] = trim(preg_replace('/\s+/', ' ', strtolower($name)));
    }

    /**
     * Gets the rating visibility option
     *
     * @param string $name
     * @return string
     */
    public function getNameAttribute(string $name)
    {
        return trim(preg_replace('/\s+/', ' ', ucfirst($name)));
    }
}
