<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use PragmaRX\Countries\Package\Countries;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Countries::all() as $country) {
            DB::table('countries')->insert([
                'name' => $country->name->common,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
