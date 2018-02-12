<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'username', 'description', 'country', 'rating_count',
        'rating_visibility', 'newsletter', 'email_offers', 'rank'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The relations to be eager loaded every time a user is fetched from the database
     *
     * @var array
     */
    protected $with = [
        'wishlist', 'ratingVisibility'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'newsletter' => 'boolean',
        'email_offers' => 'boolean',
    ];

    /**
     * Fetch user Rating Visibility
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ratingVisibility()
    {
        return $this->belongsTo(RatingVisibility::class);
    }

    /**
     * Fetch user wines on his wishlist
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function wishlist()
    {
        return $this->belongsToMany(Wine::class)->withTimestamps();
    }

    /**
     * Set the user's first name.
     *
     * @param  string  $firstname
     * @return void
     */
    public function setFirstNameAttribute(string $firstname)
    {
        $this->attributes['first_name'] = strtolower($firstname);
    }

    /**
     * Get the user's first name.
     *
     * @param  string  $firstname
     * @return string
     */
    public function getFirstNameAttribute(string $firstname)
    {
        return ucwords($firstname);
    }

    /**
     * Set the user's last name.
     *
     * @param  string  $lastname
     * @return void
     */
    public function setLastNameAttribute(string $lastname)
    {
        $this->attributes['last_name'] = strtolower($lastname);
    }

    /**
     * Get the user's last name.
     *
     * @param  string  $lastname
     * @return string
     */
    public function getLastNameAttribute(string $lastname)
    {
        return ucwords($lastname);
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the user's rating visibility name.
     *
     * @return string
     */
    public function getRatingVisibilityNameAttribute()
    {
        return ucwords($this->ratingVisibility->name);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'username';
    }
}