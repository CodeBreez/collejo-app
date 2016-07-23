<?php

namespace Collejo\App\Modules\Media\Providers;

use Collejo\Core\Providers\Module\ModuleServiceProvider as BaseModuleServiceProvider;
use Illuminate\Routing\Router;

class MediaModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $namespace = 'Collejo\App\Modules\Media\Http\Controllers';

    protected $name = 'media';

    public function boot(Router $router)
    {
        $this->initModule();
    }
    
    public function register()
    {

    }
}
