<?php

namespace Collejo\App\Modules\Media\Providers;

use Collejo\Foundation\Modules\BaseModuleServiceProvider as ModuleServiceProvider;

class MediaModuleServiceProvider extends ModuleServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Returns an array of permissions for the current module.
     *
     * @return array
     */
    public function getPermissions()
    {
        return [];
    }
}
