<?php

use App\City;
use App\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'city_id' => function () {
            return factory(City::class)->create()->id;
        },
        'name' => $faker->randomElement(['Work Address', 'Personal Address']),
        'street' => $faker->streetAddress,
        'post_code' => $faker->numberBetween(001, 999),
        'is_primary' => $faker->boolean
    ];
});
