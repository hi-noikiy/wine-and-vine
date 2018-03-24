<?php

use App\Country;
use Faker\Generator as Faker;

$factory->define(Country::class, function (Faker $faker) {
    return [
        'name' =>$faker->country,
        'cca2' => $faker->countryCode,
        'cca3' => $faker->countryCode,
        'emoji' => $faker->word,
        'address_format' => $faker->words(3, true),
        'continent' => $faker->word,
        'eu_member' => $faker->boolean,
        'svg_path' => $faker->url
    ];
});
