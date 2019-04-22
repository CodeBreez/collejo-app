<?php

namespace Collejo\App\Modules\Media\Presenters;

use Collejo\Foundation\Presenter\BasePresenter;

class MediaBasicInformationPresenter extends BasePresenter
{

    protected $hidden = [
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'bucket',
        'mime',
        'ext',
    ];

    protected $appends = [
        'small_url',
    ];
}