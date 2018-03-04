<?php

namespace Collejo\App\Providers;

use Collejo\Foundation\Menus\Menu;
use Collejo\Foundation\Modules\Module;
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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        /**
         * Load any non production providers.
         */
        $providers = config('app.non_production_mode_providers');

        if (is_array($providers) && !$this->app->environment('production')) {
            foreach ($providers as $provider) {
                $this->app->register($provider);
            }
        }

        $this->app->bind('modules', function ($app) {
            return new Module($app);
        });

        $this->app->bind('menus', function ($app) {
            return new Menu($app);
        });
    }
}
