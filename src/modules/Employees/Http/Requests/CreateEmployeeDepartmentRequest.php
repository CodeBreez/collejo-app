<?php

namespace Collejo\App\Modules\Employees\Http\Requests;

use Collejo\App\Http\Requests\Request;

class CreateEmployeeDepartmentRequest extends Request
{

	public function rules()
	{
	    return [
	        'name' => 'required|unique:employee_departments',
	        'code' => 'unique:employee_departments|max:5',
	    ];
	}

	public function attributes()
	{
		return [
	        'name' => trans('employees::employee_department.name'),
	        'code' => trans('employees::employee_department.code'),
	    ];
	}
}