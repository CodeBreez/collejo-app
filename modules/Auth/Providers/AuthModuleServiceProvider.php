<?php

namespace Collejo\App\Modules\Auth\Providers;

use Collejo\Core\Support\ModuleServiceProvider;
use Illuminate\Routing\Router;
use Collejo\Core\Contracts\Repository\UserRepository as UserRepositoryContract;
use Collejo\App\Repository\UserRepository;

class AuthModuleServiceProvider extends ModuleServiceProvider
{

    private $namespace = 'Collejo\App\Modules\Auth\Http\Controllers';

    public function boot(Router $router)
    {
        $this->loadViewsFrom([realpath(__DIR__ . '/../resources/views')], 'auth');
        
        $this->loadTranslationsFrom(realpath(__DIR__ . '/../resources/lang'), 'auth');

        $router->group([
            'namespace' => $this->namespace, 'middleware' => 'web',
        ], function ($router) {
            require_once realpath(__DIR__ . '/../Http/routes.php');
        });
    }

    public function register()
    {
        $this->app->bind(UserRepositoryContract::class, function($app) { 
            return new UserRepository($app); 
        });
    }
}
