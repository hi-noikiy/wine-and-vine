<?php

use App\{
    Acidity, Body, Color
};
use Faker\Generator as Faker;

$factory->define(App\Grape::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'short_description' => $faker->words(3, true),
        'description' => $faker->text,
        'acidity_id' => function () {
            if (($acidities = Acidity::all())->isEmpty()) {
                return factory(Acidity::class)->create()->id;
            }
            return $acidities->random()->id;
        },
        'body_id' => function () {
            if (($bodies = Body::all())->isEmpty()) {
                return factory(Body::class)->create()->id;
            }
            return $bodies->random()->id;
        },
        'color_id' => function () {
            if (($colors = Color::all())->isEmpty()) {
                return factory(Color::class)->create()->id;
            }
            return $colors->random()->id;
        }
    ];
});
