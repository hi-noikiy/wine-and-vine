<?php

use App\FoodPair;
use Faker\Generator as Faker;

$factory->define(FoodPair::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word
    ];
});
