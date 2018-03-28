<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Currency::class, function (Faker $faker) {
    $currency = collect(config('wine-and-vine.data.currencies'))->random();
    return [
        'name' => $currency['name'],
        'short_name' => $currency['short_name'],
        'symbol' => $currency['symbol'],
        'format' => $currency['format'],
        'created_at' => Carbon::now(),
        'updated_at' => null
    ];
});
