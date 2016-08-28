<?php

namespace Collejo\App\Modules\Employees\Http\Requests;

use Collejo\App\Http\Requests\Request;

class CreateEmployeePositionRequest extends Request
{

	public function rules()
	{
	    return [
	        'name' => 'required|unique:employee_positions'
	    ];
	}

	public function attributes()
	{
		return [
	        'name' => trans('employees::employee_position.name')
	    ];
	}
}