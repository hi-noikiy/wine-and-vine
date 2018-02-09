<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->randomElement(['Public', 'Friends', 'Private'])
    ];
});