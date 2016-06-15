<?php

namespace Collejo\App\Providers;

use Illuminate\Support\ServiceProvider;
use Collejo\Core\Contracts\Repository\UserRepository as UserRepositoryContract;
use Collejo\App\Repository\UserRepository;

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
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
    }
}
