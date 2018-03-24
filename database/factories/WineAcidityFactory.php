<?php

use App\WineAcidity;
use Faker\Generator as Faker;

$factory->define(WineAcidity::class, function (Faker $faker) {
    $acidity = collect(config('wine-and-vine.data.images.wine_acidities'))->random();

    return [
        'name'  => $acidity['name'],
        'image' => $acidity['normal'],
        'thumbnail' => $acidity['thumbnail']
    ];
});
