<?php

use App\City;
use App\Region;
use Faker\Generator as Faker;

$factory->define(City::class, function (Faker $faker) {
    return [
        'name'      => $faker->unique()->city,
        'region_id' => ($region = Region::all())->isEmpty() ? factory(Region::class)->create()->id : $region->random()->id,
    ];
});
