<?php

use App\User;
use App\Winery;
use Faker\Generator as Faker;

$factory->define(Winery::class, function (Faker $faker) {
    return [
        'name' => $faker->words(3, true),
        'email' => $faker->unique()->email,
        'phone_number' => $faker->unique()->phoneNumber,
        'mobile_number' => $faker->unique()->phoneNumber,
        'owner_id' => ($user = User::all())->isEmpty() ? factory(User::class)->create()->id : $user->random()->id,
    ];
});
