<?php

namespace Collejo\App\Modules\ACL\Providers;

use Collejo\App\Modules\ACL\Contracts\UserRepository as UserRepositoryContract;
use Collejo\App\Modules\ACL\Repositories\UserRepository;
use Collejo\Foundation\Modules\BaseModuleServiceProvider as ModuleServiceProvider;

class AuthModuleServiceProvider extends ModuleServiceProvider
{
    public function register()
    {
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
    }

    /**
     * Returns an array of permissions for the current module.
     *
     * @return array
     */
    public function getPermissions()
    {
        return [
            'create_admin'                  => [],
            'add_remove_permission_to_role' => ['add_edit_role', 'disable_role'],
            'view_user_account_info'        => ['edit_user_account_info', 'reset_user_password', 'disable_user'],
        ];
    }
}
