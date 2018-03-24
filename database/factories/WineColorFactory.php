<?php

use App\WineColor;
use Faker\Generator as Faker;

$factory->define(WineColor::class, function (Faker $faker) {
    $color = collect(config('wine-and-vine.data.images.wine_colors'))->random();

    return [
        'name'  => $color['name'],
        'image' => $color['normal'],
        'thumbnail' => $color['thumbnail']
    ];
});
