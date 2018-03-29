<?php

use App\User;
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
        create(Winery::class, [
            'owner_id' => User::all()->random()->id
        ], 10)
            ->each(function ($winery) {
                $winery->address()
                    ->save(create(Address::class, [
                        'addressable_id' => $winery->id,
                        'addressable_type' => Winery::class
                    ]));
                // Employ 1 to 4 users on each winery
                $winery->employees()
                    ->attach(User::all()
                        ->chunk(mt_rand(1, 4))
                        ->first());
            });
    }
}
