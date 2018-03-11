<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WineAciditySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::table('wine_acidities')->insert([
                'name' => 'low',
                'image' => storage_path('app/public/images/grape/acidity/low.png'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('wine_acidities')->insert([
                'name' => 'medium',
                'image' => storage_path('app/public/images/grape/acidity/medium.png'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('wine_acidities')->insert([
                'name' => 'high',
                'image' => storage_path('app/public/images/grape/acidity/high.png'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('wine_acidities')->insert([
                'name' => 'very high',
                'image' => storage_path('app/public/images/grape/acidity/very_high.png'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        } catch (Exception $e){}
    }
}
