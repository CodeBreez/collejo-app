<?php

namespace Collejo\App\Modules\Employees\Providers;

use Collejo\Core\Foundation\Module\ModuleServiceProvider as BaseModuleServiceProvider;

class EmployeesModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $namespace = 'Collejo\App\Modules\Employees\Http\Controllers';

    protected $name = 'employees';

    protected $permissions = ['create_employee', 'edit_employee', 'delete_employee', 'undelete_employee', 'view_employee'];

    public function boot()
    {
        $this->initModule();
    }

    public function register()
    {

    }
}
