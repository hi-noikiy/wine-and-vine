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
        'rating_visibility_id', 'newsletter', 'email_offers', 'rank'
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
        'wishlist', 'rating', 'addresses'
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
     * Fetch all User's known addresses
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    /**
     * Fetch User's Rating Visibility
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rating()
    {
        return $this->belongsTo(RatingVisibility::class, 'rating_visibility_id');
    }

    /**
     * Fetch User's wines wishlist
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function wishlist()
    {
        return $this->belongsToMany(Wine::class)->withTimestamps();
    }

    /**
     * Set the User's first name.
     *
     * @param  string $firstname
     * @return void
     */
    public function setFirstNameAttribute(string $firstname)
    {
        $this->attributes['first_name'] = trim(preg_replace('/\s+/', ' ', strtolower($firstname)));
    }

    /**
     * Get the User's first name.
     *
     * @param  string $firstname
     * @return string
     */
    public function getFirstNameAttribute(string $firstname)
    {
        return trim(preg_replace('/\s+/', ' ', ucwords($firstname)));
    }

    /**
     * Set the User's last name.
     *
     * @param  string $lastname
     * @return void
     */
    public function setLastNameAttribute(string $lastname)
    {
        $this->attributes['last_name'] = trim(preg_replace('/\s+/', ' ', strtolower($lastname)));
    }

    /**
     * Get the User's last name.
     *
     * @param  string $lastname
     * @return string
     */
    public function getLastNameAttribute(string $lastname)
    {
        return trim(preg_replace('/\s+/', ' ', ucwords($lastname)));
    }

    /**
     * Get the User's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the User's rating visibility name.
     *
     * @return string
     */
    public function getRatingVisibilityNameAttribute()
    {
        return trim(preg_replace('/\s+/', ' ', ucwords($this->rating->name)));
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