<?php

namespace Collejo\App\Modules\Classes\Providers;

use Collejo\Core\Foundation\Module\ModuleServiceProvider as BaseModuleServiceProvider;

class ClassesModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $namespace = 'Collejo\App\Modules\Classes\Http\Controllers';

    protected $name = 'classes';

    public function boot()
    {
        $this->initModule();
    }

    public function register()
    {

    }

    public function getPermissions()
    {
        return [
            'add_edit_batch' => function($user){
                return $user->hasPermission('add_edit_batch');
            },
            'add_edit_class' => function($user){
                return $user->hasPermission('add_edit_class');
            }, 
            'add_edit_grade' => function($user){
                return $user->hasPermission('add_edit_grade');
            },
            'list_batches' => function($user){
                return $user->hasPermission('list_batches');
            },
            'view_batch_details' => function($user){
                return $user->hasPermission('view_batch_details');
            }, 
            'list_grades' => function($user){
                return $user->hasPermission('list_grades');
            }, 
            'list_classes' => function($user){
                return $user->hasPermission('list_classes');
            }, 
            'view_class_details' => function($user){
                return $user->hasPermission('view_class_details');
            }, 
            'list_class_students' => function($user){
                return $user->hasPermission('list_class_students');
            }, 
            'transfer_batch' => function($user){
                return $user->hasPermission('transfer_batch');
            }, 
            'graduate_batch' => function($user){
                return $user->hasPermission('graduate_batch');
            }
        ];
    }    
}
