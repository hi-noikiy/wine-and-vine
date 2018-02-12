<?php

use App\Winery;
use App\User;
use Faker\Generator as Faker;

$factory->define(Winery::class, function (Faker $faker) {
    return [
        'name' => $faker->words(3, true),
        'user_id' => function () {
            if (($users = User::all())->isEmpty())
                return factory(User::class)->create()->id;
            return $users->random()->id;
        },
        'email' => $faker->unique()->email,
        'phone_number' => $faker->unique()->phoneNumber,
        'mobile_number' => $faker->unique()->phoneNumber,
    ];
});