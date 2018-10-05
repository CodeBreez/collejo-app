<?php

namespace Collejo\App\Modules\ACL\Http\Requests;

use Collejo\Foundation\Http\Requests\Request;

class CreateUserRequest extends Request
{
    public function rules()
    {
        return [
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->json('id'),
            'date_of_birth' => 'date',
        ];
    }

    public function attributes()
    {
        return [
            'first_name' => trans('acl::user.first_name'),
            'email' => trans('acl::user.email'),
            'date_of_birth' => trans('acl::user.date_of_birth'),
        ];
    }
}
