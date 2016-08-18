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
            'create_batch' => function($user){
                return $user->hasPermission('create_batch');
            },
            'edit_batch' => function($user){
                return $user->hasPermission('edit_batch');
            },
            'delete_batch' => function($user){
                return $user->hasPermission('delete_batch');
            }, 
            'view_batch' => function($user){
                return $user->hasPermission('view_batch');
            }
        ];
    }    
}
