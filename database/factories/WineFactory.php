<?php

use App\{
    Acidity, Body, Color, Region, Winery, WineType
};
use Faker\Generator as Faker;

$factory->define(App\Wine::class, function (Faker $faker) {
    return [
        'name'              => $faker->word,
        'description'       => $faker->text,
        'year'              => $faker->year,
        'price'             => $faker->randomFloat(2, 0, 1000),
        'quantity_in_stock' => $faker->randomNumber(3),
        'rating_count'      => $faker->randomNumber(3),
        'rating_sum'        => $faker->randomNumber(3),
        'temperature'       => $faker->numberBetween(8, 24),
        'alcohol'           => $faker->numberBetween(8, 24),
        'acidity_id'        => ($acidities = Acidity::all())->isEmpty() ? factory(Acidity::class)->create()->id : $acidities->random()->id,
        'body_id'           => ($bodies = Body::all())->isEmpty() ? factory(Body::class)->create()->id : $bodies->random()->id,
        'color_id'          => ($colors = Color::all())->isEmpty() ? factory(Color::class)->create()->id : $colors->random()->id,
        'winery_id'         => ($winery = Winery::all())->isEmpty() ? factory(Winery::class)->create()->id : $winery->random()->id,
        'wine_type_id'      => ($type = WineType::all())->isEmpty() ? factory(WineType::class)->create()->id : $type->random()->id,
        'food_pairing'      => $faker->randomElement([
            'Poultry', 'Rich Fish (Salmon, Tuna, etc...)', 'Sweet Desserts', 'Veal', 'Spicy Food', 'Junk Food'
        ])
    ];
});