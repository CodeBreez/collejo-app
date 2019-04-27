<?php

namespace Collejo\App\Modules\Employees\Presenters;

use Collejo\App\Modules\ACL\Presenters\UserBasicInformationPresenter;
use Collejo\Foundation\Presenter\BasePresenter;

class EmployeeListPresenter extends BasePresenter
{
    protected $load = [
        'user' => UserBasicInformationPresenter::class,
        'employee_department' => EmployeeDepartmentPresenter::class,
        'employee_position' => EmployeePositionPresenter::class,
        'employee_grade' => EmployeeGradePresenter::class,
    ];

    protected $hidden = [
        'user_id',
        'image_id',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
