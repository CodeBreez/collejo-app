<?php

namespace Collejo\App\Modules\Employees\Providers;

use Collejo\App\Modules\Employees\Contracts\EmployeeRepository as EmployeeRepositoryContract;
use Collejo\App\Modules\Employees\Criteria\EmployeeListCriteria;
use Collejo\App\Modules\Employees\Repositories\EmployeeRepository;
use Collejo\Foundation\Modules\BaseModuleServiceProvider as ModuleServiceProvider;

class EmployeesModuleServiceProvider extends ModuleServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EmployeeRepositoryContract::class, EmployeeRepository::class);
        $this->app->bind(EmployeeListCriteria::class);
    }

    /**
     * Returns an array of permissions for the current module.
     *
     * @return array
     */
    public function getPermissions()
    {
        return [
            'view_employee_general_details'     => ['edit_employee_general_details', 'view_employee_class_details', 'view_employee_contact_details', 'view_employee_recruitment_details', 'list_employees'],
            'view_employee_class_details'       => ['assign_employee_to_class'],
            'view_employee_contact_details'     => ['edit_employee_contact_details'],
            'view_employee_recruitment_details' => ['edit_employee_recruitment_details'],
            'list_employees'                    => ['create_employee'],
            'list_employee_positions'           => ['add_edit_employee_position'],
            'add_edit_employee_position'        => ['list_employee_categories', 'add_edit_employee_category'],
            'list_employee_grades'              => ['add_edit_employee_grade'],
            'list_employee_departments'         => ['add_edit_employee_department'],
        ];
    }
}
