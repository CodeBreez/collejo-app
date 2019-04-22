<?php

namespace Collejo\App\Modules\ACL\Presenters;

use Collejo\App\Modules\ACL\Models\User;
use Collejo\Foundation\Presenter\BasePresenter;

class ClassBasicInformationPresenter extends BasePresenter
{
    protected $class = User::class;

    protected $hidden = [
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
