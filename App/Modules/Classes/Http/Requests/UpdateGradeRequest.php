<?php

namespace Collejo\App\Modules\Classes\Http\Requests;

use Collejo\Foundation\Http\Requests\Request;

class UpdateGradeRequest extends Request
{
    public function rules()
    {
        $createRequest = new CreateGradeRequest();

        return $createRequest->rules();
    }

    public function attributes()
    {
        $createRequest = new CreateGradeRequest();

        return $createRequest->attributes();
    }
}
