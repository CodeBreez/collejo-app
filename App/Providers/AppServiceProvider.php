<?php

namespace Collejo\App\Providers;

use Illuminate\Support\ServiceProvider;
use Collejo\Foundation\Modules\Modules;
use Collejo\Foundation\Modules\Langs;

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
		    return new Modules();
	    });

	    $this->app->bind('langs', function ($app) {
		    return new Langs();
	    });
    }
}
