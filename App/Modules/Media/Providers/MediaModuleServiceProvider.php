<?php

namespace Collejo\App\Modules\Media\Providers;

use Collejo\App\Modules\Classes\Contracts\MediaRepositoryContract;
use Collejo\Foundation\Modules\BaseModuleServiceProvider as ModuleServiceProvider;
use MediaRepository;

class MediaModuleServiceProvider extends ModuleServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MediaRepositoryContract::class, MediaRepository::class);
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
