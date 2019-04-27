<?php

namespace Collejo\App\Modules\Students\Presenters;

use Collejo\App\Modules\ACL\Presenters\UserBasicInformationPresenter;
use Collejo\Foundation\Presenter\BasePresenter;

class GuardianDetailsPresenter extends BasePresenter
{
    protected $load = [
        'user'             => UserBasicInformationPresenter::class,
    ];

    protected $appends = [
        'name',
        'first_name',
        'last_name',
    ];

    protected $hidden = [
        'user_id',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
