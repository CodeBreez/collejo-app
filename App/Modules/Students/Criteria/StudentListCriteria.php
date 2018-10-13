<?php

namespace Collejo\App\Modules\Students\Criteria;

use Collejo\App\Modules\Students\Models\Student;
use Collejo\Foundation\Criteria\BaseCriteria;

class StudentListCriteria extends BaseCriteria
{
    protected $model = Student::class;

    protected $criteria = [
            ['name', '%LIKE%'],
        ];

}
