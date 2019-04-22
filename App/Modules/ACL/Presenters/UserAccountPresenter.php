<?php

namespace Collejo\App\Modules\ACL\Presenters;

use Collejo\Foundation\Presenter\BasePresenter;

class UserAccountPresenter extends BasePresenter
{

    protected $hidden = [
        'password',
    ];

    protected $appends = [
        'name',
    ];
}