<?php

namespace Collejo\App\Modules\Auth\Providers;

use Collejo\App\Foundation\Module\ModuleServiceProvider as BaseModuleServiceProvider;
use Collejo\App\Contracts\Repository\UserRepository as UserRepositoryContract;
use Collejo\App\Repository\UserRepository;
use Illuminate\Routing\Router;

class AuthModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $namespace = 'Collejo\App\Modules\Auth\Http\Controllers';

    public function boot(Router $router)
    {
        $this->initModule();
    }

    public function register()
    {
        $this->app->bind(UserRepositoryContract::class, function($app) { 
            return new UserRepository($app); 
        });
    }
}
