<?php

namespace Collejo\App\Modules\Students\Presenters;

use Collejo\App\Modules\ACL\Presenters\UserBasicInformationPresenter;
use Collejo\Foundation\Presenter\BasePresenter;

class GuardianListPresenter extends BasePresenter
{
    protected $load = [
        'user' => UserBasicInformationPresenter::class,
    ];

    protected $appends = [
        'name',
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
