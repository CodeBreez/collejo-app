<?php

namespace Collejo\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use Lang;
use Collejo\Repository\UserRepository;
use Collejo\Core\Foundation\Setup;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom([
                base_path('themes/basic/views'),
                __DIR__ . '/../resources/views'
            ], 'collejo');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'collejo');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepository::class, function($app) { 
            return new UserRepository($app); 
        });

        $this->app->bind(Setup::class, function($app) { 
            return new Setup(new UserRepository($app)); 
        });
    }
}
