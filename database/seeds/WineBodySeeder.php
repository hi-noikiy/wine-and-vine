<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WineBodySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::table('wine_bodies')->insert([
                'name' => 'very light-bodied',
                'image' => storage_path('app/public/images/grape/acidity/very_light_bodied.png'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('wine_bodies')->insert([
                'name' => 'medium-bodied',
                'image' => storage_path('app/public/images/grape/acidity/medium_bodied.png'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('wine_bodies')->insert([
                'name' => 'full-bodied',
                'image' => storage_path('app/public/images/grape/acidity/full_bodied.png'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('wine_bodies')->insert([
                'name' => 'very full-bodied',
                'image' => storage_path('app/public/images/grape/acidity/very_full_bodied.png'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        } catch (Exception $e){}
    }
}
