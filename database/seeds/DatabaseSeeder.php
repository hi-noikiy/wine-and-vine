<?php

use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Delete all images
        (new Filesystem())->cleanDirectory(storage_path('app/public/images'));

        $this->call([
            RatingVisibilitiesSeeder::class,
            RoleSeeder::class,
            CurrencySeeder::class,
            CountrySeeder::class,
            RegionSeeder::class,
            WineAciditySeeder::class,
            WineBodySeeder::class,
            WineColorSeeder::class,
            FoodPairSeeder::class,
            WineOriginDenominationSeeder::class,
            WineTypeSeeder::class,
            GrapeSeeder::class,
            UserSeeder::class,
            WinerySeeder::class,
            WineSeeder::class,
        ]);
    }
}
