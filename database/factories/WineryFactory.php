<?php

use App\User;
use App\Region;
use App\Winery;
use Faker\Generator as Faker;

$factory->define(Winery::class, function (Faker $faker) {
    return [
        'name' => $faker->words(3, true),
        'email' => $faker->unique()->email,
        'phone_number' => $faker->unique()->phoneNumber,
        'mobile_number' => $faker->unique()->phoneNumber,
        'owner_id' => ($users = User::all())->isEmpty() ? create(User::class)->id : $users->random()->id,
        'region_id' => ($regions = Region::all())->isEmpty() ? create(Region::class)->id : $regions->random()->id,
    ];
});
