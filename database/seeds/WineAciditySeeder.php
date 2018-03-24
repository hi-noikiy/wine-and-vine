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
        foreach (config('wine-and-vine.data.images.wine_acidities') as $acidity) {
            DB::table('wine_acidities')->insert([
                'name' => $acidity['name'],
                'image' => $acidity['normal'],
                'thumbnail' => $acidity['thumbnail'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => null
            ]);
        }
    }
}
