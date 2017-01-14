<?php

namespace Collejo\App\Modules\Subjects\Providers;

use Collejo\App\Foundation\Module\ModuleServiceProvider as BaseModuleServiceProvider;

class SubjectsModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $namespace = 'Collejo\App\Modules\Subjects\Http\Controllers';

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
            'list_subjects' => ['create_subject']
        ];
    }    
}
