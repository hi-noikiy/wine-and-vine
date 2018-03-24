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
        foreach (config('wine-and-vine.data.images.wine_colors') as $color) {
            DB::table('wine_colors')->insert([
                'name' => $color['name'],
                'image' => $color['normal'],
                'thumbnail' => $color['thumbnail'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => null
            ]);
        }
    }
}
