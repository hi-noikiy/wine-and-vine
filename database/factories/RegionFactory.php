<?php

use App\Region;
use App\Country;
use Faker\Generator as Faker;

$factory->define(Region::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'country_id' => function () {
            if (($countries = Country::all())->isEmpty()) {
                return factory(Country::class)->create()->id;
            }
            return $countries->random()->id;
        },
        'description' => $faker->text()
    ];
});
