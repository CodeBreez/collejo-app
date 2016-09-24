<?php

namespace Collejo\App\Modules\Employees\Providers;

use Collejo\Core\Foundation\Module\ModuleServiceProvider as BaseModuleServiceProvider;
use Collejo\App\Modules\Employees\Criteria\EmployeeListCriteria;

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
        $this->app->bind(EmployeeListCriteria::class);
    }

    public function getPermissions()
    {
        return [
            'view_employee_class_details' => function($user){
                return $user->hasPermission('view_employee_class_details');
            },
            'view_employee_contact_details' => function($user){
                return $user->hasPermission('view_employee_contact_details');
            },
            'view_employee_recrutement_details' => function($user){
                return $user->hasPermission('view_employee_recrutement_details');
            },
            'assign_employee_to_class' => function($user){
                return $user->hasPermission('assign_employee_to_class');
            },
            'edit_employee_recrutement_details' => function($user){
                return $user->hasPermission('edit_employee_recrutement_details');
            },
            'create_employee' => function($user){
                return $user->hasPermission('create_employee');
            },
            'edit_employee' => function($user){
                return $user->hasPermission('edit_employee');
            },
            'add_edit_employee_position' => function($user){
                return $user->hasPermission('add_edit_employee_position');
            },
            'add_edit_employee_category' => function($user){
                return $user->hasPermission('add_edit_employee_category');
            },
            'add_edit_employee_grade' => function($user){
                return $user->hasPermission('add_edit_employee_grade');
            },
            'add_edit_employee_department' => function($user){
                return $user->hasPermission('add_edit_employee_department');
            }
        ];
    }    
}
