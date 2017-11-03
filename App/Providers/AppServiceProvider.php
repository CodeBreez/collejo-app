<?php

namespace Collejo\App\Providers;

use Illuminate\Support\ServiceProvider;
use Collejo\Foundation\Modules\Modules;
use Collejo\Foundation\Menus\Menus;


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
		    return new Modules($app);
	    });

	    $this->app->bind('menus', function ($app) {
		    return new Menus($app);
	    });
    }
}
