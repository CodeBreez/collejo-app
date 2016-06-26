<?php

namespace Collejo\App\Modules\Students\Http\Requests;

use Collejo\App\Http\Requests\Request;

class UpdateStudentAccountRequest extends Request
{

	public function rules()
	{
	    return [
	        'email' => 'email|unique:users,email,' . $this->get('uid'),
	        'password' => 'required_with:email'
	    ];
	}

	public function attributes()
	{
		return [
	        'email' => 'Email',
	        'password' => 'Password'
	    ];
	}
}