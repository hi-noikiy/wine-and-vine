<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'username' => $faker->unique()->userName,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
        'description' => $faker->text,
        'country' => $faker->country,
        'avatar' => "/images/avatar/default.png",
        'rating_count' => rand(0, 100),
//        'rating_visibility' => '',
        'newsletter' => !! random_int(0, 1),
        'email_offers' => !! random_int(0, 1),
        'rank' => $faker->unique()->randomNumber(2),
        'remember_token' => str_random(10),
    ];
});
