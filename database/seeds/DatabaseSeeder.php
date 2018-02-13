<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RatingVisibilitiesSeeder::class,
            AddressSeeder::class,
            UserSeeder::class,
            WinerySeeder::class,
            WineSeeder::class,
        ]);
    }
}
