<?php

namespace Collejo\App\Providers;

use Illuminate\Support\ServiceProvider;
use Collejo\Core\Contracts\Repository\UserRepository as UserRepositoryContract;
use Collejo\App\Repository\UserRepository;
use Collejo\Core\Contracts\Repository\StudentRepository as StudentRepositoryContract;
use Collejo\App\Repository\StudentRepository;
use Collejo\Core\Contracts\Repository\EmployeeRepository as EmployeeRepositoryContract;
use Collejo\App\Repository\EmployeeRepository;
use Collejo\Core\Contracts\Repository\ClassRepository as ClassRepositoryContract;
use Collejo\App\Repository\ClassRepository;
use Collejo\Core\Contracts\Repository\GuardianRepository as GuardianRepositoryContract;
use Collejo\App\Repository\GuardianRepository;

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
        $this->app->bind(GuardianRepositoryContract::class, GuardianRepository::class);
        $this->app->bind(EmployeeRepositoryContract::class, EmployeeRepository::class);
        $this->app->bind(ClassRepositoryContract::class, ClassRepository::class);
    }
}
