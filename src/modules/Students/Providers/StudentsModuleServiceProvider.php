<?php

namespace Collejo\App\Modules\Students\Providers;

use Collejo\App\Foundation\Module\ModuleServiceProvider as BaseModuleServiceProvider;
use Collejo\App\Modules\Students\Criteria\StudentListCriteria;
use Collejo\App\Modules\Students\Widgets\GuardianStudentsWidget;

class StudentsModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $namespace = 'Collejo\App\Modules\Students\Http\Controllers';

    public function boot()
    {
        $this->initModule();
    }

    public function getPermissions()
    {
        return [
            'view_student_general_details' => ['list_students', 'edit_student_general_details', 'view_student_class_details'],
            'view_student_class_details' => ['assign_student_to_class', 'view_student_class_history_details'],
            'view_student_guardian_details' => [],
            'list_students' => ['create_student', 'assign_guardian_to_student', 'list_guardians'],
            'assign_student_to_class' => [],
            'list_guardians' => ['assign_guardian_to_student', 'create_guardian', 'edit_gurdian'],
            'edit_gurdian' => ['edit_guardian_contact_details'],
            'list_student_categories' => ['add_edit_student_category'],
        ];
    }

    public function getGates()
    {
        return [
            'view_student_general_details' => function($user, $student){
                return $user->hasPermission('view_student_general_details') && 
                        ($user->guardian && $user->guardian->students->contains($student->id) ||
                           $user->student && $user->student->id == $student->id ||
                           $user->employee && $user->employee->classes->contains($student->id) ||
                           $user->hasRole('admin'));
            },
            'view_student_class_history_details' => function($user, $student){
                return $user->hasPermission('view_student_general_details') && 
                        ($user->guardian && $user->guardian->students->contains($student->id) ||
                           $user->student && $user->student->id == $student->id ||
                           $user->hasRole('employee') ||
                           $user->hasRole('admin'));
            }
        ];
    }

    public function register()
    {
        $this->app->bind(StudentListCriteria::class);
    }

}
