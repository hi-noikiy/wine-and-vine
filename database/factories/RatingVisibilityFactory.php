<?php

use Faker\Generator as Faker;
use App\RatingVisibility as Ratings;

$factory->define(Ratings::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word
    ];
});
