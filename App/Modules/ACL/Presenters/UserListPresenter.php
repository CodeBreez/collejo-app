<?php

namespace Collejo\App\Modules\ACL\Presenters;

use Collejo\Foundation\Presenter\BasePresenter;

class UserListPresenter extends BasePresenter
{

    protected $appends = [
        'name',
    ];

    protected $hidden = [
        'created_by',
        'updated_by',
        'created_at',
        'deleted_at',
    ];
}