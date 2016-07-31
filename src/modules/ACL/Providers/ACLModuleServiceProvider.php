<?php

namespace Collejo\App\Modules\ACL\Providers;

use Collejo\Core\Foundation\Module\ModuleServiceProvider as BaseModuleServiceProvider;
use Illuminate\Routing\Router;

class ACLModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $namespace = 'Collejo\App\Modules\ACL\Http\Controllers';

    protected $name = 'acl';

    protected $permissions = ['manage_permissions'];

    public function boot(Router $router)
    {
        $this->initModule();
    }
    
    public function register()
    {

    }
}
