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
            'create_student' => function($user){
                return $user->hasPermission('create_student');
            },
            'edit_student' => function($user){
                return $user->hasPermission('edit_student');
            },
            'view_student' => function($user){
                return $user->hasPermission('view_student');
            },
            'view_own_students' => function(){
                return $user->hasPermission('view_own_students');
            }
        ];
    }

    public function register()
    {
        $this->app->bind(StudentListCriteria::class);
    }
}
