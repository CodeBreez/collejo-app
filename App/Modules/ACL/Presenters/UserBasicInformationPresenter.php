<?php

namespace Collejo\App\Modules\ACL\Presenters;

use Collejo\Foundation\Presenter\BasePresenter;

class UserBasicInformationPresenter extends BasePresenter
{
    protected $hidden = [
        'password',
        'remember_token',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'name',
    ];
}
