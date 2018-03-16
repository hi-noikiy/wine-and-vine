<?php

use App\WineColor;
use Faker\Generator as Faker;

$factory->define(WineColor::class, function (Faker $faker) {
    $color = collect(['crimson', 'dark blue', 'black', 'yellow', 'green', 'orange', 'pink'])->random();

    return [
        'name'  => $color,
        'image' => storage_path("app/public/images/grape/color/$color.png")
    ];
});
