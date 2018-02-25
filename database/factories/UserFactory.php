<?php

use App\{
    Country, User, RatingVisibility as Rating
};
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    $username = $faker->unique()->userName;
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'username' => $username,
        'password' => '$2y$10$vCJwSQ0B6cSpgJ4I/3l70.p60GVu7W.j909osW08kpB6Y0WxRnBwq', // secret
        'description' => $faker->text,
        'avatar' => storage_path("app/public/images/user/$username.png"),
        'rating_count' => rand(0, 100),
        'newsletter' => $faker->boolean,
        'email_offers' => $faker->boolean,
        'rank' => $faker->unique()->randomNumber(2),
        'remember_token' => str_random(10),
        'rating_visibility_id' => ($ratings = Rating::all())->isEmpty() ? factory(Rating::class)->create()->id : $ratings->random()->id,
        'country_id' => ($countries = Country::all())->isEmpty() ? factory(Country::class)->create()->id : $countries->random()->id
    ];
});