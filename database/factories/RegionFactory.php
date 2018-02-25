<?php

use App\{
    Region, Country
};
use Faker\Generator as Faker;

$factory->define(Region::class, function (Faker $faker) {
    return [
        'name'        => $faker->unique()->word,
        'country_id'  => ($countries = Country::all())->isEmpty() ? factory(Country::class)->create()->id : $countries->random()->id,
        'description' => $faker->text()
    ];
});