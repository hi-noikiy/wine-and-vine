<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WineColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::table('wine_colors')->insert([
                'name' => 'black',
                'image' => storage_path('app/public/images/grape/color/black.png'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('wine_colors')->insert([
                'name' => 'crimson',
                'image' => storage_path('app/public/images/grape/color/crimson.png'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('wine_colors')->insert([
                'name' => 'dark blue',
                'image' => storage_path('app/public/images/grape/color/dark_blue.png'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('wine_colors')->insert([
                'name' => 'green',
                'image' => storage_path('app/public/images/grape/color/green.png'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('wine_colors')->insert([
                'name' => 'orange',
                'image' => storage_path('app/public/images/grape/color/orange.png'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('wine_colors')->insert([
                'name' => 'pink',
                'image' => storage_path('app/public/images/grape/color/pink.png'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
            DB::table('wine_colors')->insert([
                'name' => 'yellow',
                'image' => storage_path('app/public/images/grape/color/yellow.png'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        } catch (Exception $e) {
        }
    }
}
