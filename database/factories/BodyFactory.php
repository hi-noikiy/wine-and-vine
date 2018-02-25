<?php

use Faker\Generator as Faker;

$factory->define(App\Body::class, function (Faker $faker) {
    $body = collect([
        ['name' => 'very light-bodied', 'image' => 'very_light_body.png'],
        ['name' => 'medium-bodied', 'image' => 'medium_bodied.png'],
        ['name' => 'full-bodied', 'image' => 'full_bodied.png'],
        ['name' => 'very full-bodied', 'image' => 'very_full_bodied.png']
    ])->random();
    return [
        'name'  => $body['name'],
        'image' => storage_path("app/public/images/grape/body/${body['image']}.png")
    ];
});