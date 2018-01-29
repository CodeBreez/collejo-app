<?php

namespace Collejo\App\Modules\Classes\Providers;

use Collejo\App\Modules\BaseModuleServiceProvider as ModuleServiceProvider;
use Collejo\App\Modules\Classes\Contracts\ClassRepository as ClassRepositoryContract;
use Collejo\App\Modules\Classes\Repository\ClassRepository;

class ClassesModuleServiceProvider extends ModuleServiceProvider
{

    protected $namespace = 'Collejo\App\Modules\Classes\Http\Controllers';

    public function boot()
    {
        $this->initModule();
    }

	public function register()
	{
		$this->app->bind(ClassRepositoryContract::class, ClassRepository::class);
	}

    public function getPermissions()
    {
        return [
            'view_batch_details' => ['add_edit_batch', 'list_batches'],
            'list_batches' => ['transfer_batch', 'graduate_batch'],
            'view_grade_details' => ['add_edit_grade', 'list_grades', 'view_class_details'],
            'view_class_details' => ['add_edit_class', 'list_classes', 'list_class_students'],
        ];
    }
}
