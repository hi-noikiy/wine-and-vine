<?php

use App\User;
use App\Wine;
use App\Grape;
use App\FoodPair;
use Illuminate\Database\Seeder;

class WineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        create(Wine::class, [], 10)
            ->each(function ($wine) {
                // Giving each wine some 1 to 4 castes
                $wine->castes()
                    ->sync(Grape::all()
                        ->chunk(rand(1, 4))
                        ->first());
                // Giving to each wine some 1 to 4 food pairings
                $wine->food_pairing()
                    ->sync(FoodPair::all()
                        ->chunk(rand(1, 4))
                        ->first());
                // Assigning each wine to 1 to 4 user wishlists
                $wine->wishlists()
                    ->sync(User::all()
                        ->chunk(mt_rand(1, 4))
                        ->first());
                // Assigning each wine to 1 to 4 user ratings
                User::all()->chunk(mt_rand(1, 4))
                    ->first()
                    ->each(function ($user) use ($wine) {
                        $user->wineRatings()
                            ->attach($wine, ['rate' => mt_rand(1, 5)]);
                    });
            });
    }
}
