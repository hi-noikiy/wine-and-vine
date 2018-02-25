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
        'rating_visibility_id', 'newsletter', 'email_offers', 'rank', 'country_id'
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
        'wishlist', 'rating', 'addresses', 'country'
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
     * Fetch User's Winery's that he owns
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function owns()
    {
        return $this->hasMany(Winery::class, 'owner_id');
    }

    /**
     * Fetch User's Winery's where he works
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function employedAt()
    {
        return $this->belongsToMany(Winery::class);
    }

    public function countryName()
    {
        return $this->country->name;
    }

    /**
     * Set the User's first name.
     *
     * @param  string $first_name
     * @return void
     */
    public function setFirstNameAttribute(string $first_name)
    {
        $this->attributes['first_name'] = trim(preg_replace('/\s+/', ' ', strtolower($first_name)));
    }

    /**
     * Get the User's first name.
     *
     * @param  string $first_name
     * @return string
     */
    public function getFirstNameAttribute(string $first_name)
    {
        return trim(preg_replace('/\s+/', ' ', ucwords($first_name)));
    }

    /**
     * Set the User's last name.
     *
     * @param  string $last_name
     * @return void
     */
    public function setLastNameAttribute(string $last_name)
    {
        $this->attributes['last_name'] = trim(preg_replace('/\s+/', ' ', strtolower($last_name)));
    }

    /**
     * Get the User's last name.
     *
     * @param  string $last_name
     * @return string
     */
    public function getLastNameAttribute(string $last_name)
    {
        return trim(preg_replace('/\s+/', ' ', ucwords($last_name)));
    }

    /**
     * Fetch the User's country
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
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
     * Attaches the User and a given Winery to the user_winery pivot table
     *
     * @param $winery
     */
    public function employTo($winery)
    {
        $this->employedAt()->attach($winery);
    }

    /**
     * Detaches the User and a given Winery from the user_winery pivot table
     *
     * @param $winery
     */
    public function quitFrom($winery)
    {
        $this->employedAt()->detach($winery);
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