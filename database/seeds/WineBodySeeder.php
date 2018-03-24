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
        foreach (config('wine-and-vine.data.images.wine_bodies') as $body) {
            DB::table('wine_bodies')->insert([
                'name' => $body['name'],
                'image' => $body['normal'],
                'thumbnail' => $body['thumbnail'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => null
            ]);
        }
    }
}
