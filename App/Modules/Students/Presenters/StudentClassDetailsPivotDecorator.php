<?php

namespace Collejo\App\Modules\Students\Presenters;

use Collejo\App\Modules\Classes\Models\Batch;
use Collejo\App\Modules\Classes\Models\Clasis;
use Collejo\App\Modules\Classes\Presenters\BatchBasicDetailsPresenter;
use Collejo\App\Modules\Classes\Presenters\ClassBasicDetailsPresenter;
use Collejo\Foundation\Presenter\ModelDecorator;

class StudentClassDetailsPivotDecorator extends ModelDecorator
{
    protected $modelReference = [
        'class_id' => [Clasis::class, ClassBasicDetailsPresenter::class, 'class'],
        'batch_id' => [Batch::class, BatchBasicDetailsPresenter::class, 'batch'],
    ];
}
