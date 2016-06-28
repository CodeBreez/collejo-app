<?php

namespace Collejo\App\Providers;

use Illuminate\Support\ServiceProvider;
use Collejo\Core\Contracts\Module\Module as ModuleInterface;
use Collejo\Core\Foundation\Module\Module;
use Collejo\Core\Foundation\Module\ModuleCollection;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(ModuleCollection $modules)
    {
        $modules->loadModules();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ModuleInterface::class, function($app) { 
            return new Module(); 
        });

        $this->app->singleton('modules', function ($app) {
            return new ModuleCollection($app);
        });

    }
}
