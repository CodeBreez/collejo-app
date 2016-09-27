<?php

namespace Collejo\App\Modules\ACL\Providers;

use Collejo\App\Foundation\Module\ModuleServiceProvider as BaseModuleServiceProvider;
use Illuminate\Routing\Router;

class ACLModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $namespace = 'Collejo\App\Modules\ACL\Http\Controllers';

    public function boot(Router $router)
    {
        $this->initModule();
    }
    
    public function register()
    {

    }

    public function getPermissions()
    {
        return [
            'create_admin' => [],
            'add_remove_permission_to_role' => ['add_edit_role', 'disable_role'],
            'view_user_account_info' => ['edit_user_account_info', 'reset_user_password', 'disable_user'],
        ];
    }
}
