<?php

namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvide extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */

    public function boot()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Damage\DamageInterface', 'App\Repositories\Damage\DamageRepository');
        $this->app->bind('App\Repositories\Customer\CustomerInterface', 'App\Repositories\Customer\CustomerRepository');
        $this->app->bind('App\Repositories\Shops\ShopsInterface', 'App\Repositories\Shops\ShopsRepository');
    }
}
