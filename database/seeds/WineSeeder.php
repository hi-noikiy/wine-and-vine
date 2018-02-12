<?php

use App\Wine;
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
        factory(Wine::class, 50)->create();
    }
}
