<?php
/*
     * TIPO
     * vinhos de mesa -> branco, tinto e rosé
     * espumantes
     * frutificados
     *
     * CLASSIFICACAO
     * classificação [doc -> 65pts, igp -> 60 pts, comuns]
     * designativo de qualidade [reserva]
     */
namespace App;

use Illuminate\Database\Eloquent\Model;

class   Wine extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'year', 'price', 'description', 'quantity_in_stock',
        'rating_count', 'rating_sum', 'temperature', 'alcohol',
        'acidity_id', 'body_id', 'color_id', 'food_pairing', 'winery_id', 'wine_type_id'
    ];

    /**
     * The relations to be eager loaded every time a wine is fetched from the database
     *
     * @var array
     */
    protected $with = [
        'acidity', 'body', 'castes', 'color', 'type', 'winery', //'wishlists'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Fetch the Wine's acidity
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function acidity()
    {
        return $this->belongsTo(Acidity::class);
    }

    /**
     * Fetch the Wine's body
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function body()
    {
        return $this->belongsTo(Body::class);
    }

    /**
     * Fetch the Wine's color
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    /**
     * Returns the Wine's castes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function castes()
    {
        return $this->BelongsToMany(Grape::class);
    }

    /**
     * Returns Wine's type
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(WineType::class, 'wine_type_id');
    }

    /**
     * Returns the Wine's winery
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function winery()
    {
        return $this->belongsTo(Winery::class);
    }

    /**
     * Returns the User's that wishes this particular wine
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function wishlists()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * Fetch the Wine's region
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region()
    {
        return $this->winery->region();
    }

    /**
     * Fetch the Wine's country name
     *
     * @return Country
     */
    public function country()
    {
        return $this->winery->country();
    }

    /**
     * Fetch the Wine's rating
     *
     * @return float
     */
    public function rating() : float
    {
        return $this->rating_sum / $this->rating_count;
    }

    /**
     * Set the wine's name
     *
     * @param string $name
     * @return void
     */
    public function setNameAttribute(string $name): void
    {
        $this->attributes['name'] = trim(preg_replace('/\s+/', ' ', strtolower($name)));
    }

    /**
     * Fetch the wine's name
     *
     * @param string $name
     * @return string
     */
    public function getNameAttribute(string $name): string
    {
        return trim(preg_replace('/\s+/', ' ', ucwords($name)));
    }

    /**
     * Set the wine's description
     *
     * @param string $description
     * @return void
     */
    public function setDescriptionAttribute(string $description): void
    {
        $this->attributes['description'] = trim(preg_replace('/\s+/', ' ', $description));
    }

    /**
     * Fetch the wine's description
     *
     * @param string $description
     * @return string
     */
    public function getDescriptionAttribute(string $description): string
    {
        return trim(preg_replace('/\s+/', ' ', $description));
    }
}