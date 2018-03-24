<?php

use App\Winery;
use App\Address;
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
                    ->save(factory(Address::class)
                        ->create([
                            'addressable_id' => $winery->id,
                            'addressable_type' => Winery::class
                        ]));
            });
    }
}
