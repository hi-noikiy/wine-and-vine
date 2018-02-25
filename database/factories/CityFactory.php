<?php

use App\{
    City, Region
};
use Faker\Generator as Faker;

$factory->define(City::class, function (Faker $faker) {
    return [
        'name'      => $faker->unique()->city,
        'postcode'  => $faker->numberBetween(1000, 9999),
        'region_id' => ($region = Region::all())->isEmpty() ? factory(Region::class)->create()->id : $region->random()->id,
    ];
});
