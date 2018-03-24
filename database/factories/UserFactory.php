<?php

use App\User;
use App\Address;
use App\Country;
use Faker\Generator as Faker;
use App\RatingVisibility as Rating;

$id = 1;

$factory->define(User::class, function (Faker $faker) use (&$id) {
    $username = $faker->unique()->userName;

    return [
        'id' => $id++,
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
        'shipping_address_id' => function ($user) {
            return factory(Address::class)->create([
                'addressable_id' => $user['id'],
                'addressable_type' => User::class
            ])->id;
        },
        'rating_visibility_id' => ($ratings = Rating::all())->isEmpty() ? create(Rating::class)->id : $ratings->random()->id,
        'country_id' => ($countries = Country::all())->isEmpty() ? create(Country::class)->id : $countries->random()->id
    ];
});
