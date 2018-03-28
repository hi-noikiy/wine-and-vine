<?php

use App\Address;
use App\Winery;
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
        create(Winery::class, [], 10)
            ->each(function ($winery) {
                $winery->address()
                    ->save(create(Address::class, [
                        'addressable_id' => $winery->id,
                        'addressable_type' => Winery::class
                    ]));
            });
    }
}
