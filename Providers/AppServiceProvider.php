<?php

namespace Collejo\App\Providers;

use Illuminate\Support\ServiceProvider;
use Collejo\Core\Contracts\Repository\UserRepository as UserRepositoryContract;
use Collejo\App\Repository\UserRepository;
use Collejo\Core\Contracts\Repository\StudentRepository as StudentRepositoryContract;
use Collejo\App\Repository\StudentRepository;

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

        $this->loadTranslationsFrom(realpath(__DIR__ . '/../resources/lang'), null);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(StudentRepositoryContract::class, StudentRepository::class);
    }
}
