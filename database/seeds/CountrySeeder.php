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
        $countries = Countries::all()->reject(function ($country) {
            return strpos($country['name']['common'], 'Europe') !== false;
        });

        foreach ($countries as $country) {
            DB::table('countries')->insert([
                'name' => $country->name->common,
                'cca2' => $country->cca2,
                'cca3' => $country->cca3,
                'emoji' => $country['extra']['emoji'] ?? null,
                'address_format' => $country['extra']['address_format'] ?? null,
                'continent' => collect($continent ?? null)->first(),
                'eu_member' => $country['extra']['eu_member'] ?? false,
                'svg_path' => $country['flag']['svg_path'] ?? null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
