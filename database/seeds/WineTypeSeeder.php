<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WineTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wine_types')->insert([
            'name' => 'table wine',
            'created_at' => now()
        ]);

        DB::table('wine_types')->insert([
            'name' => 'fortified',
            'created_at' => now()
        ]);

        DB::table('wine_types')->insert([
            'name' => 'sparkling',
            'created_at' => now()
        ]);
    }
}
