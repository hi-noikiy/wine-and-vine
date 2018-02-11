<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\{
    User as Authenticatable
};

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'password', 'username', 'country',
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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ratingVisibility()
    {
        return $this->hasOne(RatingVisibility::class);
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
     * Get the user's first name.
     *
     * @param  string  $firstname
     * @return string
     */
    public function getFirstNameAttribute($firstname)
    {
        return ucfirst($firstname);
    }

    /**
     * Get the user's last name.
     *
     * @param  string  $lastname
     * @return string
     */
    public function getLastNameAttribute($lastname)
    {
        return ucfirst($lastname);
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }
}
