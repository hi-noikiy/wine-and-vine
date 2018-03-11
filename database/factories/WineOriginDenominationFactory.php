<?php

use App\WineOriginDenomination;
use Faker\Generator as Faker;

$factory->define(WineOriginDenomination::class, function (Faker $faker) {
    $name = $faker->unique()->words(3, true);
    return [
        'short_name' => $name,
        'name' => function () use ($name) {
            $initials = "";
            collect(explode(' ', $name))->each(function ($word) use (&$initials) {
                $initials .= $word[0];
            });
            return $initials;
        }
    ];
});
