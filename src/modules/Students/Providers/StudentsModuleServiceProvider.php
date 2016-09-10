<?php

namespace Collejo\App\Modules\Students\Providers;

use Collejo\Core\Foundation\Module\ModuleServiceProvider as BaseModuleServiceProvider;
use Collejo\App\Modules\Students\Criteria\StudentListCriteria;

class StudentsModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $namespace = 'Collejo\App\Modules\Students\Http\Controllers';

    protected $name = 'students';

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
            }
        ];
    }

    public function register()
    {
        $this->app->bind(StudentListCriteria::class);
    }
}
