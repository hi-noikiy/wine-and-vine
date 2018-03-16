<?php

use App\{
    Address, Country, RatingVisibility as Rating, User, Wine
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
        factory(User::class)->create([
            'first_name' => 'Rafael',
            'last_name' => 'Macedo',
            'email' => 'macedorjd.dev@gmail.com',
            'password' => 'secret',
            'username' => 'rafaelmacedo',
            'rating_visibility_id' => Rating::first()->id,
            'country_id' => Country::whereName('Portugal')->first()->id,
        ])->assignRole('admin');

        $wines = Wine::all();
        factory(User::class, 9)->create()
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