<?php

use App\{
    User, RatingVisibility
};
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'username' => $faker->unique()->userName,
        'password' => '$2y$10$vCJwSQ0B6cSpgJ4I/3l70.p60GVu7W.j909osW08kpB6Y0WxRnBwq', // secret
        'description' => $faker->text,
        'avatar' => "/images/avatar/default.png",
        'rating_count' => rand(0, 100),
        'rating_visibility_id' => function () {
            if (($ratings = RatingVisibility::all())->isEmpty())
                return factory(RatingVisibility::class, 3)->create()->random()->id;
            return $ratings->random()->id;
        },
        'newsletter' => $faker->boolean,
        'email_offers' => $faker->boolean,
        'rank' => $faker->unique()->randomNumber(2),
        'remember_token' => str_random(10),
    ];
});
