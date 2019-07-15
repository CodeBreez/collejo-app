<?php

namespace Collejo\App\Modules\Students\Presenters;

use Collejo\Foundation\Presenter\BasePresenter;

class StudentClassDetailsPresenter extends BasePresenter
{
    protected $decorate = [
        'pivot'       => StudentClassDetailsPivotDecorator::class,
    ];

    protected $hidden = [
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
