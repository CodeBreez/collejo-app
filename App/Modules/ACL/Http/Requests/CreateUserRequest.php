<?php

namespace Collejo\App\Modules\ACL\Http\Requests;

use Collejo\Foundation\Http\Requests\Request;

class CreateUserRequest extends Request
{
    public function rules()
    {
        return [
            'first_name' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'first_name' => trans('acl::user.first_name'),
        ];
    }
}
