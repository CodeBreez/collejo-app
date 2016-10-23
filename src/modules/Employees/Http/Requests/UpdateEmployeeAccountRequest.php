<?php

namespace Collejo\App\Modules\Employees\Http\Requests;

use Collejo\App\Http\Requests\Request;

class UpdateEmployeeAccountRequest extends Request
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
	        'email' => trans('employees::employee.email'),
	        'password' => trans('employees::employee.password')
	    ];
	}
}