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
            'country_id' => Country::where('cca2', 'PT')->first()->id,
        ])->assignRole('admin');

        create(User::class, [], 9)
            ->each(function ($user) {
                $user->addresses()->save(create(Address::class, [
                    'addressable_id' => $user->id,
                    'addressable_type' => User::class,
                ]));

                $newly_created_wines = create(Wine::class, [], rand(1, 5));
                $user->wishlist()->attach($newly_created_wines);
                $newly_created_wines->each(function ($wine) {
                    $wine->winery->address()->save(create(Address::class));
                });

                if (rand(0, 1)) {
                    $newly_created_wineries = create(Winery::class, [], rand(1, 3));
                    $user->employedAt()->attach($newly_created_wineries);
                    $newly_created_wineries->each(function ($winery) {
                        $winery->address()->save(create(Address::class));
                    });
                }

                if (rand(0, 1)) {
                    $user->wineries()->save($winery_ = create(Winery::class));
                    $winery_->address()->save(create(Address::class));
                }
            });
    }
}
