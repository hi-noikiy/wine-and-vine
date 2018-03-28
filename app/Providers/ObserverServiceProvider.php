<?php

namespace App\Providers;

use App\Address;
use App\Country;
use App\Observers\AddressObserver;
use App\Observers\CountryObserver;
use App\Observers\RegionObserver;
use App\Region;
use App\User;
use App\Wine;
use App\Winery;
use App\Observers\UserObserver;
use App\Observers\WineObserver;
use App\Observers\WineryObserver;
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
