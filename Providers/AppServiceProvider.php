<?php

namespace Collejo\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use Lang;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom([__DIR__ . '/../resources/views'], 'collejo');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'collejo');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
