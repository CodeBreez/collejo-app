<?php

namespace Collejo\App\Modules\ACL\Providers;

use Collejo\App\Modules\BaseModuleServiceProvider as ModuleServiceProvider;
use Collejo\App\Modules\ACL\Contracts\UserRepository as UserRepositoryContract;
use Collejo\App\Modules\ACL\Repositories\UserRepository;

class ACLModuleServiceProvider extends ModuleServiceProvider
{

    public function register()
    {
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
    }
}
