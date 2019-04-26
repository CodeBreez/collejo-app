<?php

namespace Collejo\App\Modules\Employees\Presenters;

use Collejo\App\Modules\ACL\Presenters\UserBasicInformationPresenter;
use Collejo\App\Modules\Media\Presenters\MediaBasicInformationPresenter;
use Collejo\Foundation\Presenter\BasePresenter;

class EmployeeDetailsPresenter extends BasePresenter
{
    protected $load = [
        'picture'          => MediaBasicInformationPresenter::class,
        'user' => UserBasicInformationPresenter::class,
        'employee_department' => EmployeeDepartmentPresenter::class,
        'employee_position' => EmployeePositionPresenter::class,
        'employee_grade' => EmployeeGradePresenter::class,
    ];

    protected $appends = [
        'name',
        'first_name',
        'last_name',
        'date_of_birth',
    ];

    protected $hidden = [
        'user_id',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
