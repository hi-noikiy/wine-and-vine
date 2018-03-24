<?php

use App\WineBody;
use Faker\Generator as Faker;

$factory->define(WineBody::class, function (Faker $faker) {
    $body = collect(config('wine-and-vine.data.images.wine_bodies'))->random();

    return [
        'name'  => $body['name'],
        'image' => $body['normal'],
        'thumbnail' => $body['thumbnail']
    ];
});
