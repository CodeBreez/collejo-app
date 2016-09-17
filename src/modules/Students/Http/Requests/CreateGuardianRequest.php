<?php

namespace Collejo\App\Modules\Students\Http\Requests;

use Collejo\App\Http\Requests\Request;

class CreateGuardianRequest extends Request
{

	public function rules()
	{
	    return [
	        'first_name' => 'required',
	        'last_name' => 'required',
	        'ssn' => 'required|unique:guardians',
	        'email' => 'unique:users'
	    ];
	}

	public function attributes()
	{
		return [
	        'first_name' => 'First Name',
	        'last_name' => 'Last Name',
	        'ssn' => 'SSN',
	        'email' => 'Email',
	    ];
	}
}