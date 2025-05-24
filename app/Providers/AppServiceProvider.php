<?php

namespace App\Providers;

use App\Repositories\Eloquent\Filesrepository;
use App\Repositories\Eloquent\Userrepository;
use App\Repositories\interface\Filesinterface;
use App\Repositories\interface\Userinterface;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Userinterface::class, Userrepository::class);
        $this->app->bind(Filesinterface::class, Filesrepository::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
