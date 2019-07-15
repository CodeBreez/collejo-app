<?php

namespace Collejo\App\Modules\Employees\Presenters;

use Collejo\Foundation\Presenter\BasePresenter;

class EmployeePositionPresenter extends BasePresenter
{
    protected $load = [
        'employee_category' => EmployeeCategoryPresenter::class,
    ];

    protected $hidden = [
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
