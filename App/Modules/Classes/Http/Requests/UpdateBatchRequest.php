<?php

namespace Collejo\App\Modules\Classes\Http\Requests;

use Collejo\Foundation\Http\Requests\Request;

class UpdateBatchRequest extends Request
{
    public function rules()
    {
        $createRequest = new CreateBatchRequest();

        return $createRequest->rules();
    }

    public function attributes()
    {
        $createRequest = new CreateBatchRequest();

        return $createRequest->attributes();
    }
}
