<?php

namespace App\Providers;

use App\User;
use App\Wine;
use App\Region;
use App\Winery;
use App\Address;
use App\Country;
use App\Observers\UserObserver;
use App\Observers\WineObserver;
use App\Observers\RegionObserver;
use App\Observers\WineryObserver;
use App\Observers\AddressObserver;
use App\Observers\CountryObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(new UserObserver);
        Winery::observe(new WineryObserver);
        Wine::observe(new WineObserver);
        Address::observe(new AddressObserver);
        Country::observe(new CountryObserver);
        Region::observe(new RegionObserver);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
