<?php

use App\User;
use App\Wine;
use App\Winery;
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
        create(User::class, [
            'first_name' => 'Rafael',
            'last_name' => 'Macedo',
            'email' => 'rafael@wine-vine.com',
            'password' => 'secret',
            'username' => 'rafael_macedo',
            'rating_visibility_id' => Rating::first()->id,
            'country_id' => Country::whereName('Portugal')->first()->id,
        ])->assignRole('admin');

        $wines = Wine::all();
        $wineries = Winery::all();
        create(User::class, [], 9)
            ->each(function ($user) use ($wines, $wineries) {
                $user->addresses()->save(factory(Address::class)->create([
                    'addressable_id' => $user->id,
                    'addressable_type' => User::class,
                ]));

                $user->wishlist()->attach(
                    $wines->isEmpty() ? create(Wine::class, [], rand(1, 5)) : $wines->chunk(rand(1, 5))->first()
                );

                $user->employedAt()->attach(
                    $wineries->isEmpty() ? create(Winery::class, [], rand(1, 3)) : $wineries->chunk(rand(1, 3))->first()
                );

                if (rand(0, 1)) {
                    $user->wineries()->save(
                        $wineries->isEmpty() ? create(Winery::class) : $wineries->first()
                    );
                }
            });
    }
}
