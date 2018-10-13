<?php

namespace Collejo\App\Modules\Students\Providers;

use Collejo\App\Modules\Students\Contracts\StudentRepository as StudentRepositoryContract;
use Collejo\App\Modules\Students\Criteria\StudentListCriteria;
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
    }

    /**
     * Returns an array of permissions for the current module.
     *
     * @return array
     */
    public function getPermissions()
    {
        return [
            'view_student_details' => ['add_edit_student', 'list_students'],
        ];
    }
}
