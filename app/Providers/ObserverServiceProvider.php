<?php

namespace App\Providers;

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
