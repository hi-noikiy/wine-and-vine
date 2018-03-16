<?php

use App\Winery;
use App\Address;
use App\FoodPair;
use App\WineBody;
use App\WineType;
use App\WineColor;
use App\WineAcidity;
use Faker\Generator as Faker;
use App\WineOriginDenomination;

$factory->define(App\Wine::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->text,
        'year' => $faker->year,
        'price' => $faker->randomFloat(2, 0, 1000),
        'quantity_in_stock' => $faker->randomNumber(3),
        'rating_count' => $faker->randomNumber(3),
        'rating_sum' => $faker->randomNumber(3),
        'temperature' => $faker->numberBetween(8, 24),
        'alcohol' => $faker->numberBetween(8, 24),
        'wine_acidity_id' => ($acidities = WineAcidity::all())->isEmpty() ? factory(WineAcidity::class)->create()->id : $acidities->random()->id,
        'wine_body_id' => ($bodies = WineBody::all())->isEmpty() ? factory(WineBody::class)->create()->id : $bodies->random()->id,
        'wine_color_id' => ($colors = WineColor::all())->isEmpty() ? factory(WineColor::class)->create()->id : $colors->random()->id,
        'wine_origin_denomination_id' => ($classifications = WineOriginDenomination::all())->isEmpty() ? factory(WineOriginDenomination::class)->create()->id : $classifications->random()->id,
        'wine_type_id' => ($type = WineType::all())->isEmpty() ? factory(WineType::class)->create()->id : $type->random()->id,
        'winery_id' => function ($wine) {
            if (($wineries = Winery::all())->isEmpty()) {
                ($winery = factory(Winery::class)->create())->address()->save(factory(Address::class)->create([
                    'addressable_id' => $winery->id,
                    'addressable_type' => Winery::class
                ]));

                return $winery->id;
            }

            return $wineries->random()->id;
        },
        'food_pairing_id' => ($pairs = FoodPair::all())->isEmpty() ? factory(FoodPair::class)->create() : $pairs->random()->id
    ];
});
