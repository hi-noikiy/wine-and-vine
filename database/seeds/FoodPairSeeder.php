<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FoodPairSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('food_pairs')->insert([
            'name' => 'Poultry',
            'created_at' => Carbon::now()
        ]);

        DB::table('food_pairs')->insert([
            'name' => 'Rich Fish (Salmon, Tuna, etc...)',
            'created_at' => Carbon::now()
        ]);

        DB::table('food_pairs')->insert([
            'name' => 'Sweet Desserts',
            'created_at' => Carbon::now()
        ]);

        DB::table('food_pairs')->insert([
            'name' => 'Veal',
            'created_at' => Carbon::now()
        ]);

        DB::table('food_pairs')->insert([
            'name' => 'Spicy Food',
            'created_at' => Carbon::now()
        ]);

        DB::table('food_pairs')->insert([
            'name' => 'Junk Food',
            'created_at' => Carbon::now()
        ]);
    }
}
