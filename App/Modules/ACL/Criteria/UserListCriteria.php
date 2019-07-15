<?php

namespace Collejo\App\Modules\ACL\Criteria;

use Collejo\App\Modules\ACL\Contracts\UserRepository;
use Collejo\App\Modules\ACL\Models\User;
use Collejo\Foundation\Criteria\BaseCriteria;

class UserListCriteria extends BaseCriteria
{
    protected $model = User::class;

    protected $criteria = [
            ['name', 'LIKE%'],
            ['email', '%LIKE%'],
            ['role_id', '=', 'role'],
        ];

    protected $selects = [
            'role_id' => 'role_user.role_id',
            'name'    => 'CONCAT(users.first_name, \' \', users.last_name)',
        ];

    protected $joins = [
            ['role_user', 'users.id', 'role_user.user_id'],
        ];

    protected $form = [
        'role' => [
            'type'          => 'select',
            'itemsCallback' => 'userRoles',
        ],
    ];

    public function callbackUserRoles()
    {
        return app()->make(UserRepository::class)->getRoles()->get();
    }
}
