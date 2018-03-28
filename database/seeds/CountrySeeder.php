<?php

use App\Country;
use App\Currency;
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
                'continent' => collect($country['geo']['continent'])->first(),
                'eu_member' => $country['extra']['eu_member'] ?? false,
                'svg_path' => $country['flag']['svg_path'] ?? null,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
        $currencies = Currency::all();
        foreach (Country::all() as $country) {
            $is_british = $country->cca === 'GB';
            $is_eu_member = $country->eu_member;
            $currency = $is_british
                ? $currencies->where('short_name', 'GBP')->first()
                : ($is_eu_member
                    ? $currencies->where('short_name', 'EUR') ->first()
                    : $currencies->where('short_name', 'USD')->first());
            $country->currencies()->sync($currency->id);
        }
    }
}
