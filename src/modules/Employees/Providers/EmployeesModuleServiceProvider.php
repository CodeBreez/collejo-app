<?php

namespace Collejo\App\Modules\Employees\Providers;

use Collejo\Core\Foundation\Module\ModuleServiceProvider as BaseModuleServiceProvider;

class EmployeesModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $namespace = 'Collejo\App\Modules\Employees\Http\Controllers';

    protected $name = 'employees';

    public function boot()
    {
        $this->initModule();
    }

    public function register()
    {

    }

    public function getPermissions()
    {
        return [
            'create_employee' => function($user){
                return $user->hasPermission('create_employee');
            },
            'edit_employee' => function($user){
                return $user->hasPermission('edit_employee');
            },
            'view_employee' => function($user){
                return $user->hasPermission('view_employee');
            }
        ];
    }    
}
