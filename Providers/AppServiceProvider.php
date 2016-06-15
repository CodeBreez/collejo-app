<?php

namespace Collejo\App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom([realpath(__DIR__ . '/../resources/views')], 'collejo');

        $this->loadTranslationsFrom(realpath(__DIR__ . '/../resources/lang'), 'collejo');
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
