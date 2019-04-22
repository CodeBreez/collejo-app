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
            'view_student_general_details'  => ['list_students', 'view_student_class_details'],
            'view_student_class_details'    => ['assign_student_to_class', 'view_student_class_history_details'],
            'view_student_guardian_details' => [],
            'edit_student_general_details'  => ['create_student'],
            'view_student_contact_details'  => ['edit_student_contact_details'],
            'list_students'                 => ['assign_guardian_to_student', 'list_guardians', 'list_student_categories'],
            'assign_student_to_class'       => [],
            'list_guardians'                => ['assign_guardian_to_student', 'create_guardian', 'edit_guardian'],
            'edit_guardian'                 => ['edit_guardian_contact_details'],
            'view_guardian_contact_details' => ['edit_guardian_contact_details'],
            'list_student_categories'       => ['add_edit_student_category'],
        ];
    }

    public function getGates()
    {
        return [
            'view_student_general_details' => function ($user, $student) {
                return $user->hasPermission('view_student_general_details') &&
                    ($user->hasRole('guardian') && $user->guardian && $user->guardian->students->contains($student->id) ||
                        $user->hasRole('student') && $user->student && $user->student->id == $student->id ||
                        $user->hasRole('employee') && $user->employee && $user->employee->classes->contains($student->id) ||
                        $user->hasRole('admin'));
            },
            'view_student_class_history_details' => function ($user, $student) {
                return $user->hasPermission('view_student_general_details') &&
                    ($user->hasRole('guardian') && $user->guardian && $user->guardian->students->contains($student->id) ||
                        $user->hasRole('student') && $user->student && $user->student->id == $student->id ||
                        $user->hasRole('employee') && $user->employee && $user->employee->classes->contains($student->id) ||
                        $user->hasRole('admin'));
            },
        ];
    }
}
