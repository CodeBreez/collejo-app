<?php

namespace Collejo\App\Modules\Students\Providers;

use Collejo\Core\Foundation\Module\ModuleServiceProvider as BaseModuleServiceProvider;

class StudentsModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $namespace = 'Collejo\App\Modules\Students\Http\Controllers';

    protected $name = 'students';

    protected $permissions = ['create_student', 'edit_student', 'delete_student', 'undelete_student', 'view_student'];

    public function boot()
    {
        $this->initModule();
    }

    public function register()
    {

    }
}
