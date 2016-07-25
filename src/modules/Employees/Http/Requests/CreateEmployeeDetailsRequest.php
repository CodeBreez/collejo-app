<?php

namespace Collejo\App\Modules\Students\Http\Requests;

use Collejo\App\Http\Requests\Request;

class CreateEmployeeDetailsRequest extends Request
{

	public function rules()
	{
	    return [
	        'employee_number' => 'required|unique:employees',
	        'first_name' => 'required',
	        'last_name' => 'required'
	    ];
	}

	public function attributes()
	{
		return [
	        'employee_number' => 'Employee Number',
	        'first_name' => 'First Name',
	        'last_name' => 'Last Name'
	    ];
	}
}