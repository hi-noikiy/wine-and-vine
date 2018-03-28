<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('wine-and-vine.data.currencies') as $currency) {
            DB::table('currencies')->insert([
                'name' => $currency['name'],
                'short_name' => $currency['short_name'],
                'symbol' => $currency['symbol'],
                'format' => $currency['format'],
                'created_at' => Carbon::now()
            ]);
        }
    }
}
