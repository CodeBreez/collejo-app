<?php

namespace Collejo\App\Modules\Students\Criteria;

use Collejo\App\Modules\Students\Models\Guardian;
use Collejo\Foundation\Criteria\BaseCriteria;

class GuardiansListCriteria extends BaseCriteria
{
    protected $model = Guardian::class;

    protected $criteria = [
        ['ssn', '%LIKE%', 'ssn'],
        ['name', '%LIKE%', 'name'],
    ];

    protected $selects = [
        'name' => 'CONCAT(users.first_name, \' \', users.last_name)',
    ];

    protected $joins = [
        ['users', 'guardians.user_id', 'users.id'],
    ];

    protected $form = [
        'ssn' => [
            'type'  => 'text',
            'label' => 'SSN',
        ],
    ];
}
