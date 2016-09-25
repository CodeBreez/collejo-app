<?php

namespace Collejo\App\Modules\Students\Providers;

use Collejo\Core\Foundation\Module\ModuleServiceProvider as BaseModuleServiceProvider;
use Collejo\App\Modules\Students\Criteria\StudentListCriteria;
use Collejo\App\Modules\Students\Widgets\GuardianStudentsWidget;

class StudentsModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $namespace = 'Collejo\App\Modules\Students\Http\Controllers';

    protected $widgets = [
        GuardianStudentsWidget::class
    ];

    public function boot()
    {
        $this->initModule();
    }

    public function getPermissions()
    {
        return [
            'view_student_general_details' => ['edit_student_general_details', 'view_student_class_details'],
            'view_student_class_details' => ['assign_student_to_class', 'list_students'],
            'view_student_guardian_details' => [],
            'view_student_contact_details' => [],
            'view_student_class_history_details' => [],
            'list_students' => ['create_student', 'assign_guarduan_to_student', 'list_guardians'],
            'assign_student_to_class' => [],
            'assign_guarduan_to_student' => [],
            'list_guardians' => ['assign_guarduan_to_student', 'create_guardian', 'edit_gurdian'],
            'create_guardian' => [],
            'edit_gurdian' => ['edit_guardian_contact_details'],
            'edit_guardian_contact_details' => [],
            'create_student' => [],
            'edit_student_general_details' => [],
            'list_student_categories' => ['add_edit_student_category'],
            'add_edit_student_category' => []
        ];
    }

    public function register()
    {
        $this->app->bind(StudentListCriteria::class);
    }
}
