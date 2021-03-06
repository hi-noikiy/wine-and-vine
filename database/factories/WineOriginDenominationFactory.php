<?php

use Faker\Generator as Faker;
use App\WineOriginDenomination;

$factory->define(WineOriginDenomination::class, function (Faker $faker) {
    return [
        'name' => $faker->words(3, true),
        'short_name' => $faker->word,
        'description' => $faker->sentence,
        'short_description' => str_limit($faker->sentence, 10, ''),
    ];
});
