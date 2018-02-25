<?php

use Faker\Generator as Faker;

$factory->define(App\WineType::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->randomElement(['table wine', 'sparkling', 'fortified'])
    ];
});
