<?php

namespace Collejo\App\Modules\Classes\Presenters;

use Collejo\Foundation\Presenter\BasePresenter;

class ClassBasicDetailsPresenter extends BasePresenter
{
    protected $load = [
        'grade' => GradeBasicDetailsPresenter::class
    ];

    protected $hidden = [
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
