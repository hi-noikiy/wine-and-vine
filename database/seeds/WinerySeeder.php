<?php

use App\{
    Address, Winery
};
use Illuminate\Database\Seeder;

class WinerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Winery::class, 10)->create()
            ->each(function ($winery) {
                $winery->address()->save(factory(Address::class)->create([
                    'addressable_id' => $winery->id,
                    'addressable_type' => Winery::class
                ]));
            });
    }
}
