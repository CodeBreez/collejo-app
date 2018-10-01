<?php

namespace Collejo\App\Modules\Auth\Http\Requests;

use Collejo\Foundation\Http\Requests\Request;

class LoginRequest extends Request
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'email' => trans('auth::auth.email'),
            'password' => trans('auth::auth.password'),
        ];
    }
}
