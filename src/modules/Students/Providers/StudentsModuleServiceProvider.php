<?php

namespace Collejo\App\Modules\Students\Providers;

use Collejo\Core\Foundation\Module\ModuleServiceProvider as BaseModuleServiceProvider;
use Collejo\App\Modules\Students\Criteria\StudentListCriteria;
use Collejo\App\Modules\Students\Widgets\GuardianStudentsWidget;

class StudentsModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $namespace = 'Collejo\App\Modules\Students\Http\Controllers';

    protected $name = 'students';

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
            'view_student_class_details' => function($user){
                return $user->hasPermission('view_student_class_details');
            },
            'view_student_guardian_details' => function($user){
                return $user->hasPermission('view_student_guardian_details');
            },
            'view_student_contact_details' => function($user){
                return $user->hasPermission('view_student_contact_details');
            },
            'view_student_class_history_details' => function($user){
                return $user->hasPermission('view_student_class_history_details');
            },
            'assign_student_to_class' => function($user){
                return $user->hasPermission('assign_student_to_class');
            },
            'assign_guarduan_to_student' => function($user){
                return $user->hasPermission('assign_guarduan_to_student');
            },
            'create_guardian' => function($user){
                return $user->hasPermission('create_guardian');
            },
            'edit_gurdian' => function($user){
                return $user->hasPermission('edit_gurdian');
            },
            'edit_guardian_contact_details' => function($user){
                return $user->hasPermission('edit_guardian_contact_details');
            },
            'create_student' => function($user){
                return $user->hasPermission('create_student');
            },
            'edit_student' => function($user){
                return $user->hasPermission('edit_student');
            },
            'add_edit_student_category' => function($user){
                return $user->hasPermission('add_edit_student_category');
            },
            'edit_student_class_details' => function($user){
                return $user->hasPermission('edit_student_class_details');
            }
        ];
    }

    public function register()
    {
        $this->app->bind(StudentListCriteria::class);
    }
}
