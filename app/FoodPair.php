<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class FoodPair extends Model
{
    /************************* Properties ******************************/

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /************************* Relations ******************************/

    /**
     * Fetch Food Pair's wines.
     *
     * @return BelongsToMany
     */
    public function wines(): BelongsToMany
    {
        return $this->belongsToMany(Wine::class);
    }
}
