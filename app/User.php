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
     * Fetch user Rating Visibility
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ratingVisibility() {
        return $this->hasOne(RatingVisibility::class);
    }

    /**
     * Fetch user wines on his wishlist
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function wishlist() {
        return $this->belongsToMany(Wine::class)->withTimestamps();
    }
}
