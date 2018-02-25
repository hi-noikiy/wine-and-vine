<?php

use App\{
    Address, User, Wine
};
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wines = Wine::all();
        factory(User::class, 10)->create()
            ->each(function ($user) use ($wines) {
                $user->addresses()->save(factory(Address::class)->create([
                    'addressable_id' => $user->id,
                    'addressable_type' => User::class,
                ]));
                $user->wishlist()->attach(
                    $wines->isEmpty() ? factory(Wine::class, rand(1, 5))->create() : $wines->chunk(rand(1, 5))->first()
                );
            });
    }
}