<?php namespace Pikd\Providers;

use Illuminate\Support\ServiceProvider;
use Pikd\Providers\PikdUserProvider;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;

class AuthServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

    public function boot() {
        $this->app['auth']->extend('pikd_driver', function($app) {
            return new PikdUserProvider($app->make(HasherContract::class), $app->make(\Pikd\Models\Customer::class));
        });
    }
}
