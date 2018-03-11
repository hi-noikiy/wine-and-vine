<?php

use App\Grape;
use Faker\Generator as Faker;

$factory->define(Grape::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'short_description' => $faker->words(3, true),
        'description' => $faker->text,
    ];
});
