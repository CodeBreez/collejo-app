<?php

namespace Collejo\App\Modules\Employees\Providers;

use Collejo\Core\Foundation\Module\ModuleServiceProvider as BaseModuleServiceProvider;

class EmployeesModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $namespace = 'Collejo\App\Modules\Employees\Http\Controllers';

    protected $name = 'employees';

    protected $permissions = [
        'create_employee' => 'Create employees',
        'edit_employee' => 'Edit employees',
        'delete_employee' => 'Delete employees',
        'undelete_employee' => 'Undelete employees',
        'view_employee' => 'View employees'
    ];

    public function boot()
    {
        $this->initModule();
    }

    public function register()
    {

    }
}
