<?php

namespace Collejo\App\Modules\Classes\Providers;

use Collejo\Core\Foundation\Module\ModuleServiceProvider as BaseModuleServiceProvider;

class ClassesModuleServiceProvider extends BaseModuleServiceProvider
{

    protected $namespace = 'Collejo\App\Modules\Classes\Http\Controllers';

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
            'view_batch_details' => ['add_edit_batch', 'list_batches'],
            'list_batches' => ['transfer_batch', 'graduate_batch'],
            'view_class_details' => ['add_edit_class', 'list_classes', 'list_class_students'],
            'view_grade_details' => ['add_edit_grade', 'list_grades'],
        ];
    }    
}
