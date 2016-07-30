<?php

namespace Collejo\App\Modules\Classes\Providers;

use Collejo\Core\Foundation\Module\ModuleServiceProvider as BaseModuleServiceProvider;

class ClassesModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $namespace = 'Collejo\App\Modules\Classes\Http\Controllers';

    protected $name = 'classes';

    protected $permissions = [
        'create_batch' => 'Create batches',
        'edit_batch' => 'Edit batches',
        'delete_batch' => 'Delete batches',
        'view_batch' => 'View batches'
    ];

    public function boot()
    {
        $this->initModule();
    }

    public function register()
    {

    }
}
