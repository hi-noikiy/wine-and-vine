<?php

use App\City;
use App\Region;
use Faker\Generator as Faker;

$factory->define(City::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->city,
        'postcode' => $faker->numberBetween(1000, 9999),
        'region_id' => function () {
            return factory(Region::class)->create()->id;
        }
    ];
});
