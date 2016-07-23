<?php

namespace Collejo\App\Modules\Auth\Http\Controllers;

use Collejo\App\Http\Controllers\Controller;

class MediaController extends Controller
{
    public function getUploader()
    {
        return 'uploader';
    }
}
