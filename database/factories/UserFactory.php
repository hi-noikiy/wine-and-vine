<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'username' => $faker->unique()->userName,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
        'description' => $faker->text,
        'country' => $faker->country,
        'avatar' => "/images/avatar/default.png",
        'rating_count' => rand(0, 100),
        'rating_visibility_id' => function () {
            if (App\RatingVisibility::count() === 0)
                return factory(App\RatingVisibility::class, 3)->create()->pluck('id')->random();
            return App\RatingVisibility::all()->pluck('id')->random();
        },
        'newsletter' => !! random_int(0, 1),
        'email_offers' => !! random_int(0, 1),
        'rank' => $faker->unique()->randomNumber(2),
        'remember_token' => str_random(10),
    ];
});
