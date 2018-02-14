<?php

namespace Collejo\App\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->modules = app()->make('modules');

        $this->modules->loadModules();
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
