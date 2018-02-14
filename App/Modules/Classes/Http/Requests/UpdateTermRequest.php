<?php

namespace Collejo\App\Modules\Classes\Http\Requests;

use Collejo\Foundation\Http\Requests\Request;

class UpdateTermRequest extends Request
{
    public function rules()
    {
        $createRequest = new CreateTermRequest();

        return $createRequest->rules();
    }

    public function attributes()
    {
        $createRequest = new CreateTermRequest();

        return $createRequest->attributes();
    }
}
