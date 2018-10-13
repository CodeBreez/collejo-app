<?php

namespace Collejo\App\Modules\Classes\Criteria;

use Collejo\App\Modules\Classes\Models\Batch;
use Collejo\Foundation\Criteria\BaseCriteria;

class BatchListCriteria extends BaseCriteria
{
    protected $model = Batch::class;

    private $defaultSortKey = 'start_date';

    protected $criteria = [
            ['name', '%LIKE%'],
        ];

}
