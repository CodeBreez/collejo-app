<?php

namespace Collejo\App\Modules\ACL\Http\Requests;

use Collejo\Foundation\Http\Requests\Request;

class UpdateUserAccountRequest extends Request
{
    public function rules()
    {
        return [
            'email'         => 'required|email|unique:users,email,'.$this->json('id'),
            'password'  => ''
        ];
    }

    public function attributes()
    {
        return [
            'email'         => trans('acl::user.email'),
            'password'         => trans('acl::user.password'),
        ];
    }
}
