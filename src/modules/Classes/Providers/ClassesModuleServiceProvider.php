<?php

namespace Collejo\App\Modules\Classes\Providers;

use Collejo\Core\Foundation\Module\ModuleServiceProvider as BaseModuleServiceProvider;

class ClassesModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $namespace = 'Collejo\App\Modules\Classes\Http\Controllers';

    protected $name = 'classes';

    protected $permissions = ['create_batch', 'edit_batch', 'delete_batch', 'view_batch'];

    public function boot()
    {
        $this->initModule();
    }

    public function register()
    {

    }
}
