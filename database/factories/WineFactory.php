<?php

use Faker\Generator as Faker;

$factory->define(App\Wine::class, function (Faker $faker) {
    return [
        'winnery_id' => $faker->numberBetween(1, 100),
        'name' => $faker->word,
        'type' => $faker->randomElement(['Red', 'White', 'Sparkling', 'Rosé', 'Dessert', 'Port']),
        'style' => $faker->randomElement(
            ['Portuguese Douro Red', 'Portuguese Alentejo Red', 'Portuguese Dão Red', 'Portuguese Moscatel']
        ),
        'description' => $faker->text,
        'year' => $faker->year,
        'price' => $faker->randomFloat(2, 0, 1000),
        'quantity_in_stock' => $faker->randomNumber(3),
        'rating_count' => $faker->randomNumber(3),
        'rating_sum' => $faker->randomNumber(3),
        'region' => $faker->randomElement(['Douro', 'Setúbal', 'Dão', 'Ribatejo', 'Tejo', 'Alentejo', 'Algarve']),
        'country' => 'Portugal',
        'food_pairing' => $faker->randomElement([
            'Poultry', 'Rich Fish (Salmon, Tuna, etc...)', 'Sweet Desserts', 'Veal', 'Spicy Food', 'Junk Food'
        ])
    ];
});