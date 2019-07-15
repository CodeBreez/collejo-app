<?php

namespace Collejo\App\Modules\Auth\Http\Requests;

use Collejo\Foundation\Http\Requests\Request;

class ReauthRequest extends Request
{
    public function rules()
    {
        return [
            'password' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'password' => trans('auth::auth.password'),
        ];
    }
}
