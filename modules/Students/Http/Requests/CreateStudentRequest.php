<?php

namespace Collejo\App\Modules\Students\Http\Requests;

use Collejo\App\Http\Requests\Request;

class CreateStudentRequest extends Request
{

	public function rules()
	{
	    return [
	        'first_name' => 'required',
	        'last_name' => 'required',
	        'email' => 'email|unique:users',
	        'password' => 'required_with:email'
	    ];
	}

	public function attributes()
	{
		return [
	        'first_name' => 'First Name',
	        'last_name' => 'Last Name',
	        'email' => 'Email',
	        'password' => 'Password'
	    ];
	}
}