<?php

namespace Collejo\App\Modules\Media\Providers;

use Collejo\Core\Foundation\Module\ModuleServiceProvider as BaseModuleServiceProvider;
use Illuminate\Routing\Router;

class MediaModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $namespace = 'Collejo\App\Modules\Media\Http\Controllers';

    public function boot(Router $router)
    {
        $this->initModule();
    }
    
    public function register()
    {

    }

    public function getPermissions()
    {
        return [];
    }
}
