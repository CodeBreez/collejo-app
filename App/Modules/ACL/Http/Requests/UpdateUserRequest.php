<?php

namespace Collejo\App\Modules\ACL\Http\Requests;

use Collejo\Foundation\Http\Requests\Request;

class UpdateUserRequest extends Request
{
    public function rules()
    {
        $createRequest = new CreateUserRequest();

        return $createRequest->rules();
    }

    public function attributes()
    {
        $createRequest = new CreateUserRequest();

        return $createRequest->attributes();
    }
}
