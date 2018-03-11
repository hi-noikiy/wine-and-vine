<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WineOriginDenominationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wine_origin_denominations')->insert([
            'short_name' => 'DOC',
            'name' => 'Controlled Designation of Origin',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('wine_origin_denominations')->insert([
            'short_name' => 'IGP',
            'name' => 'Protected Geographical Indication',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('wine_origin_denominations')->insert([
            'short_name' => 'Wine',
            'name' => 'Table Wine',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}