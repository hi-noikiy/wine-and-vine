<?php

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
                $wine->castes()
                    ->sync(Grape::all()
                        ->chunk(rand(1, 4))
                        ->first());

                $wine->food_pairing()
                    ->sync(FoodPair::all()
                        ->chunk(rand(1, 4))
                        ->first());
            });
    }
}
