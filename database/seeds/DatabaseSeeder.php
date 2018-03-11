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
            WineAciditySeeder::class,
            WineBodySeeder::class,
            WineColorSeeder::class,
            FoodPairSeeder::class,
            WineOriginDenominationSeeder::class,
            WineTypeSeeder::class,
            UserSeeder::class,
            WinerySeeder::class,
            // UserWinerySeeder::class,
            GrapeSeeder::class,
            WineSeeder::class,
            // UserWineSeeder::class,
            // GrapeWineSeeder::class,
            RatingVisibilitiesSeeder::class,
        ]);
    }
}
