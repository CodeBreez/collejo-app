<?php

namespace Collejo\App\Modules\Students\Providers;

use Collejo\App\Modules\Students\Contracts\GuardianRepository as GuardianRepositoryContract;
use Collejo\App\Modules\Students\Contracts\StudentRepository as StudentRepositoryContract;
use Collejo\App\Modules\Students\Criteria\GuardiansListCriteria;
use Collejo\App\Modules\Students\Criteria\StudentListCriteria;
use Collejo\App\Modules\Students\Repositories\GuardianRepository;
use Collejo\App\Modules\Students\Repositories\StudentRepository;
use Collejo\Foundation\Modules\BaseModuleServiceProvider as ModuleServiceProvider;

class StudentsModuleServiceProvider extends ModuleServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StudentRepositoryContract::class, StudentRepository::class);
        $this->app->bind(StudentListCriteria::class);

        $this->app->bind(GuardianRepositoryContract::class, GuardianRepository::class);
        $this->app->bind(GuardiansListCriteria::class);
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
}
