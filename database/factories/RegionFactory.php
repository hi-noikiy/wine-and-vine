<?php

use App\Region;
use App\Country;
use Faker\Generator as Faker;

$factory->define(Region::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'country_id' => function () {
            return factory(Country::class)->create()->id;
        }
    ];
});
