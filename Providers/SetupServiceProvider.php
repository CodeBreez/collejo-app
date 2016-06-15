<?php

namespace Collejo\App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use Lang;
use Collejo\Core\Contracts\Setup\Setup as SetupContract;

class SetupServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('setup', function($app) { 
            return new Setup(new UserRepository($app)); 
        });
    }
}
