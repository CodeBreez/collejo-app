<?php

namespace Collejo\App\Providers;

use Illuminate\Support\ServiceProvider;
use Collejo\Core\Contracts\Theme\Menu as MenuInterface;
use Collejo\Core\Foundation\Theme\Menu;
use Collejo\Core\Foundation\Theme\MenuCollection;
use Collejo\Core\Contracts\Theme\Theme as ThemeInterface;
use Collejo\Core\Foundation\Theme\Theme;
use Collejo\Core\Foundation\Theme\ThemeCollection;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(ThemeCollection $themes)
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MenuInterface::class, function($app) { 
            return new Menu(); 
        });

        $this->app->singleton('menus', function ($app) {
            return new MenuCollection();
        });

        $this->app->bind(ThemeInterface::class, function($app) { 
            return new Theme(); 
        });

        $this->app->singleton('themes', function ($app) {
            return new ThemeCollection();
        });
    }
}
