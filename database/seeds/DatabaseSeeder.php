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
            CountrySeeder::class,
            RegionSeeder::class,
            CitySeeder::class,
            AciditySeeder::class,
            BodySeeder::class,
            ColorSeeder::class,
            RatingVisibilitiesSeeder::class,
            WineTypeSeeder::class,
            UserSeeder::class,
            WinerySeeder::class,
            // UserWinerySeeder::class,
            GrapeSeeder::class,
            WineSeeder::class,
            // UserWineSeeder::class,
            // GrapeWineSeeder::class,
        ]);
    }
}
