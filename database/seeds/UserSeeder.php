<?php

use App\User;
use App\Address;
use App\Country;
use Illuminate\Database\Seeder;
use App\RatingVisibility as Rating;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rafael = create(User::class, [
            'first_name' => 'Rafael',
            'last_name' => 'Macedo',
            'email' => 'rafael@wine-vine.com',
            'password' => 'secret',
            'username' => 'rafael_macedo',
            'rating_visibility_id' => Rating::first()->id,
        ]);

        $rafael->addresses()->first()->update([
            'country_id' => Country::where('cca2', 'PT')->first()->id,
            'is_primary' => true
        ]);

        // Assign an Admin role
        $rafael->assignRole('admin');

        create(User::class, [], 9)
            ->each(function ($user) {
                // Adding an address to each User
                $user->addresses()->save(create(Address::class, [
                    'addressable_id' => $user->id,
                    'addressable_type' => User::class,
                ]));
            });
    }
}
