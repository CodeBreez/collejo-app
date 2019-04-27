<?php

namespace Collejo\App\Modules\Employees\Presenters;

use Collejo\Foundation\Presenter\BasePresenter;

class EmployeeCategoryPresenter extends BasePresenter
{

    protected $hidden = [
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
