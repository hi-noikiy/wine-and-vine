<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RatingVisibilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rating_visibilities')->insert([
            'name' => 'Public',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('rating_visibilities')->insert([
            'name' => 'Friends',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('rating_visibilities')->insert([
            'name' => 'Private',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}