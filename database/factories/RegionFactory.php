<?php

use App\Region;
use App\Country;
use Faker\Generator as Faker;

$factory->define(Region::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'country_id' => ($countries = Country::all())->isEmpty() ? create(Country::class)->id : $countries->random()->id,
        'description' => $faker->text()
    ];
});
