<?php

use App\Winery;
use App\Address;
use App\Currency;
use App\WineBody;
use App\WineType;
use App\WineColor;
use App\WineAcidity;
use Faker\Generator as Faker;
use App\WineOriginDenomination;

$factory->define(App\Wine::class, function (Faker $faker) {
    return [
        'name' => $faker->words(mt_rand(1, 3), true),
        'short_description' => $faker->words(6, true),
        'description' => $faker->text,
        'year' => $faker->year,
        'price' => $faker->randomFloat(2, 0, 1000),
        'quantity_in_stock' => $faker->randomNumber(3),
        'temperature' => $faker->numberBetween(8, 24),
        'alcohol' => $faker->numberBetween(8, 24),
        'wine_acidity_id' => ($acidities = WineAcidity::all())->isEmpty()
            ? factory(WineAcidity::class)->create()->id
            : $acidities->random()->id,
        'wine_body_id' => ($bodies = WineBody::all())->isEmpty()
            ? factory(WineBody::class)->create()->id
            : $bodies->random()->id,
        'wine_color_id' => ($colors = WineColor::all())->isEmpty()
            ? factory(WineColor::class)->create()->id
            : $colors->random()->id,
        'wine_origin_denomination_id' => ($classifications = WineOriginDenomination::all())->isEmpty()
            ? factory(WineOriginDenomination::class)->create()->id
            : $classifications->random()->id,
        'wine_type_id' => ($type = WineType::all())->isEmpty()
            ? factory(WineType::class)->create()->id
            : $type->random()->id,
        'winery_id' => function ($wine) {
            if (($wineries = Winery::all())->isEmpty()) {
                ($winery = create(Winery::class))
                    ->address()
                    ->save(create(Address::class, [
                        'addressable_id' => $winery->id,
                        'addressable_type' => Winery::class
                    ]));

                return $winery->id;
            }

            return $wineries->random()->id;
        },
        'currency_id' => ($currencies = Currency::all())->isEmpty()
            ? create(Currency::class)->id
            : $currencies->random()->id
    ];
});
