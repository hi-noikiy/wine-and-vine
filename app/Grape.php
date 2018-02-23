<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grape extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'acidity', 'color', 'body'
    ];

    protected $with = [
        'acidity', 'body', 'color', 'wines'
    ];

    /**
     * Returns the Wines's where this Grape is
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function wines()
    {
        return $this->belongsToMany(Wine::class);
    }

    /**
     * Fetch the Grape's acidity
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function acidity()
    {
        return $this->belongsTo(Acidity::class);
    }

    /**
     * Fetch the Grape's body
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function body()
    {
        return $this->belongsTo(Body::class);
    }

    /**
     * Fetch the Grape's color
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}