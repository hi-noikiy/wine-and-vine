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
        try {
            DB::table('rating_visibilities')->insert([
                'name' => 'public',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('rating_visibilities')->insert([
                'name' => 'friends',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            DB::table('rating_visibilities')->insert([
                'name' => 'private',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        } catch (Exception $e) {
        }
    }
}
