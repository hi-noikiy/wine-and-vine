<?php

use Faker\Generator as Faker;
use Spatie\Permission\Models\Permission;

$factory->define(Permission::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'guard_name' => config('auth.defaults.guard')
    ];
});
