<?php

use App\RatingVisibility as Ratings;
use Faker\Generator as Faker;

$factory->define(Ratings::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word
    ];
});