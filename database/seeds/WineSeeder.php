<?php

use App\{
    Grape, Wine
};
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
        $grapes = Grape::all();
        factory(Wine::class, 10)
            ->create()
            ->each(function ($wine) use ($grapes) {
                $wine->castes()->attach(
                    $grapes->isEmpty() ? factory(Grape::class, rand(1, 4))->create() : $grapes->chunk(rand(1, 4))->first()
                );
            });
    }
}
