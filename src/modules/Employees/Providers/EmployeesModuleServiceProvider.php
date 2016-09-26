<?php

namespace Collejo\App\Modules\Employees\Providers;

use Collejo\Core\Foundation\Module\ModuleServiceProvider as BaseModuleServiceProvider;
use Collejo\App\Modules\Employees\Criteria\EmployeeListCriteria;

class EmployeesModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $namespace = 'Collejo\App\Modules\Employees\Http\Controllers';

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
            'view_employee_general_details' => ['edit_employee_general_details', 'view_employee_class_details', 'view_employee_contact_details', 'view_employee_recrutement_details', 'list_employees'],
            'view_employee_class_details' => ['assign_employee_to_class'],
            'view_employee_contact_details' => ['edit_employee_contacts'],
            'view_employee_recrutement_details' => ['edit_employee_recrutement_details'],
            'list_employees' => ['create_employee'],
            'list_employee_positions' => ['add_edit_employee_position'],
            'add_edit_employee_position' => ['add_edit_employee_category'],
            'list_employee_grades' => ['add_edit_employee_grade'],
            'list_employee_departments' => ['add_edit_employee_department'],
        ];
    }    
}
