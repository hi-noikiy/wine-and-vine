<?php

use App\Grape;
use Illuminate\Database\Seeder;

class GrapeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Grape::class, 10)->create();
    }
}
