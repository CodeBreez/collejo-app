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
        $this->app->bind('modules', function ($app) {
            return new Module($app);
        });

        $this->app->bind('menus', function ($app) {
            return new Menu($app);
        });
    }
}
