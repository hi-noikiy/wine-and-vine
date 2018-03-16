<?php

use App\WineAcidity;
use Faker\Generator as Faker;

$factory->define(WineAcidity::class, function (Faker $faker) {
    $acidity = collect([
        ['name' => 'low', 'image' => 'low.png'],
        ['name' => 'medium', 'image' => 'medium.png'],
        ['name' => 'high', 'image' => 'high.png'],
        ['name' => 'very high', 'image' => 'very_high.png']
    ])->random();

    return [
        'name'  => $acidity['name'],
        'image' => storage_path("app/public/images/grape/acidity/${acidity['image']}")
    ];
});
