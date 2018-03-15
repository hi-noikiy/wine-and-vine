<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WineOriginDenomination extends Model
{
    /************************* Properties ******************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'short_name', 'name', 'short_description', 'description'
    ];

    /************************* Relations ******************************/

    /**
     * Fetch Origin Denomination's wines
     *
     * @return HasMany
     */
    public function wines(): HasMany
    {
        return $this->hasMany(Wine::class);
    }

    /************************* Accessors ******************************/

    /**
     * Fetch Wine Origin's name
     *
     * @param string $name
     * @return string
     */
    public function getNameAttribute(string $name) : string
    {
        return trim(preg_replace('/\s+/', ' ', ucwords($name)));
    }

    /**
     * Fetch Wine Origin's short name
     *
     * @param string $short_name
     * @return string
     */
    public function getShortNameAttribute(string $short_name) : string
    {
        return trim(preg_replace('/\s+/', ' ', ucwords($short_name)));
    }

    /************************* Mutators ******************************/

    /**
     * Set the Wine Origin's name
     *
     * @param string $name
     * @return void
     */
    public function setNameAttribute(string $name) : void
    {
        $this->attributes['name'] = trim(preg_replace('/\s+/', ' ', strtolower($name)));
    }

    /**
     * Set the Wine Origin's short name
     *
     * @param string $short_name
     * @return void
     */
    public function setShortNameAttribute(string $short_name) : void
    {
        $this->attributes['short_name'] = trim(preg_replace('/\s+/', ' ', strtolower($short_name)));
    }
}