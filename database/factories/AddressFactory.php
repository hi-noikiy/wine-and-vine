<?php

use App\City;
use App\User;
use App\Winery;
use App\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    $type = '';

    return [
        'city_id' => ($cities = City::all())->isEmpty() ? factory(City::class)->create()->id : $cities->random()->id,
        'addressable_id' => function () use ($faker, &$type) {
            if ($faker->boolean) {
                $type = 'App\User';
                if (($users = User::all())->isEmpty()) {
                    return factory(User::class)->create()->id;
                }

                return $users->random()->id;
            }
            $type = 'App\Winery';
            if (($wineries = Winery::all())->isEmpty()) {
                return factory(Winery::class)->create()->id;
            }

            return $wineries->random()->id;
        },
        'addressable_type' => function () use (&$type) {
            return $type;
        },
        'type' => $faker->randomElement(['Work Address', 'Personal Address']),
        'street_name' => $faker->streetName,
        'postcode' => $faker->postcode,
        'is_primary' => $faker->boolean
    ];
});
