<?php

namespace Collejo\App\Modules\Employees\Http\Requests;

use Collejo\Foundation\Http\Requests\Request;

class CreateEmployeeDetailsRequest extends Request
{

	public function rules()
	{
	    return [
	        'employee_number' => 'required|unique:employees',
	        'first_name' => 'required',
	        'last_name' => 'required',
	        'joined_on' => 'required',
	        'employee_position_id' => 'required',
	        'employee_department_id' => 'required',
	        'employee_grade_id' => 'required',
	        'date_of_birth' => 'required'
	    ];
	}

	public function attributes()
	{
		return [
	        'employee_number' => 'Employee Number',
	        'first_name' => 'First Name',
	        'last_name' => 'Last Name',
	        'joined_on' => 'Joined Date',
	        'employee_position_id' => 'Employee Position',
	        'employee_department_id' => 'Employee Department',
	        'employee_grade_id' => 'Employee Grade',
	        'date_of_birth' => 'Date of Birth'
	    ];
	}
}