<?php

namespace Collejo\App\Modules\Students\Presenters;

use Collejo\App\Modules\ACL\Presenters\UserBasicInformationPresenter;
use Collejo\App\Modules\Media\Presenters\MediaBasicInformationPresenter;
use Collejo\Foundation\Presenter\BasePresenter;

class StudentDetailsPresenter extends BasePresenter
{

    protected $load = [
        'user' => UserBasicInformationPresenter::class,
        'picture' => MediaBasicInformationPresenter::class,
        'student_category' => StudentCategoryPresenter::class,
    ];

    protected $appends = [
        'name',
        'first_name',
        'last_name',
        'date_of_birth',
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