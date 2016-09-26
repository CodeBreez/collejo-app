<?php

namespace Collejo\App\Providers;

use Illuminate\Support\ServiceProvider;
use Collejo\App\Contracts\Widget\Widget as WidgetInterface;
use Collejo\App\Foundation\Widget\Widget;
use Collejo\App\Foundation\Widget\WidgetCollection;

class WidgetServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(WidgetCollection $widgets)
    {
        $widgets->loadWidgets();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(WidgetInterface::class, function($app) { 
            return new Widget(); 
        });

        $this->app->singleton('widgets', function ($app) {
            return new WidgetCollection($app);
        });
    }
}
