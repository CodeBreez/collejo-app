<?php

namespace Collejo\App\Modules\ACL\Providers;

use Collejo\Core\Foundation\Module\ModuleServiceProvider as BaseModuleServiceProvider;
use Illuminate\Routing\Router;

class ACLModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $namespace = 'Collejo\App\Modules\ACL\Http\Controllers';

    protected $name = 'acl';

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
            'create_admin' => function($user) {
                return $user->hasPermission('create_admin');
            },
            'create_role' => function($user) {
                return $user->hasPermission('create_role');
            },
            'disable_role' => function($user) {
                return $user->hasPermission('disable_role');
            },
            'add_remove_permission_to_role' => function($user) {
                return $user->hasPermission('add_remove_permission_to_role');
            },
            'view_user_account_info' => function($user) {
                return $user->hasPermission('view_user_account_info');
            },
            'edit_user_account_info' => function($user) {
                return $user->hasPermission('edit_user_account_info');
            },
            'reset_user_password' => function($user) {
                return $user->hasPermission('reset_user_password');
            },
            'disable_user' => function($user) {
                return $user->hasPermission('disable_user');
            }
        ];
    }    
}
