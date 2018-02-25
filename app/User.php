<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\{
    BelongsTo, BelongsToMany, HasMany, MorphMany
};
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /************************* Properties ******************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'username', 'description', 'country', 'rating_count',
        'rating_visibility_id', 'newsletter', 'email_offers', 'rank', 'country_id', 'shipping_address_id'
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

    /************************* Relations ******************************/

    /**
     * Fetch the User's shipping address instance
     *
     * @return BelongsTo
     */
    public function shipping(): BelongsTo
    {
        return $this->belongsTo(Address::class, 'shipping_address_id');
    }

    /**
     * Fetch the User's country
     *
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Fetch all User's known addresses
     *
     * @return MorphMany
     */
    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    /**
     * Fetch User's Rating Visibility
     *
     * @return BelongsTo
     */
    public function rating(): BelongsTo
    {
        return $this->belongsTo(RatingVisibility::class, 'rating_visibility_id');
    }

    /**
     * Fetch User's wines wishlist
     *
     * @return BelongsToMany
     */
    public function wishlist(): BelongsToMany
    {
        return $this->belongsToMany(Wine::class)->withTimestamps();
    }

    /**
     * Fetch User's Winery's that he owns
     *
     * @return HasMany
     */
    public function owns(): HasMany
    {
        return $this->hasMany(Winery::class, 'owner_id');
    }

    /**
     * Fetch User's Winery's where he works
     *
     * @return BelongsToMany
     */
    public function employedAt(): BelongsToMany
    {
        return $this->belongsToMany(Winery::class);
    }

    /************************* Accessors ******************************/

    /**
     * Fetch User's first name.
     *
     * @param  string $first_name
     * @return string
     */
    public function getFirstNameAttribute(string $first_name): string
    {
        return trim(preg_replace('/\s+/', ' ', ucwords($first_name)));
    }

    /**
     * Fetch User's last name.
     *
     * @param  string $last_name
     * @return string
     */
    public function getLastNameAttribute(string $last_name): string
    {
        return trim(preg_replace('/\s+/', ' ', ucwords($last_name)));
    }

    /**
     * Fetch User's full name.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "$this->first_name $this->last_name";
    }

    /**
     * Fetch User's email
     *
     * @param string $email
     * @return string
     */
    public function getEmailAttribute(string $email): string
    {
        return trim(preg_replace('/\s+/', ' ', strtolower($email)));
    }

    /**
     * Fetch User's country name
     *
     * @return string
     */
    public function getCountryNameAttribute(): string
    {
        return $this->country->name;
    }

    /**
     * Fetch User's full shipping address
     *
     * @return string
     */
    public function getShippingAddressAttribute(): string
    {
        return $this->shipping->fullAddress;
    }

    /************************* Mutators ******************************/

    /**
     * Set User's first name.
     *
     * @param  string $first_name
     * @return void
     */
    public function setFirstNameAttribute(string $first_name): void
    {
        $this->attributes['first_name'] = trim(preg_replace('/\s+/', ' ', strtolower($first_name)));
    }

    /**
     * Set User's last name.
     *
     * @param  string $last_name
     * @return void
     */
    public function setLastNameAttribute(string $last_name): void
    {
        $this->attributes['last_name'] = trim(preg_replace('/\s+/', ' ', strtolower($last_name)));
    }

    /**
     * Set User's email
     *
     * @param string $email
     * @return void
     */
    public function setEmailAttribute(string $email): void
    {
        $this->attributes['email'] = trim(preg_replace('/\s+/', ' ', strtolower($email)));
    }

    /************************* Functions ******************************/

    /**
     * Attaches the User to a given Winery
     *
     * @param Winery|integer $winery
     */
    public function employTo($winery)
    {
        $this->employedAt()->attach($winery);
    }

    /**
     * Detaches the User from a given Winery
     *
     * @param Winery|integer $winery
     */
    public function quitFrom($winery)
    {
        $this->employedAt()->detach($winery);
    }

    /************************* Functions ******************************/

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