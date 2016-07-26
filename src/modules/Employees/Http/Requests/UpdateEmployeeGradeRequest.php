<?php

namespace Collejo\App\Modules\Employees\Http\Requests;

use Collejo\App\Http\Requests\Request;

class UpdateEmployeeGradeRequest extends Request
{

	public function rules()
	{
		$createRequest = new CreateEmployeeGradeRequest();

	    return array_merge($createRequest->rules(), [
	    		'name' => 'required|unique:employee_grades,name,' . $this->get('egid'),
	        	'code' => 'max:5|unique:employee_grades,code,' . $this->get('egid'),
	    	]);
	}

	public function attributes()
	{
		$createRequest = new CreateEmployeeGradeRequest();

		return $createRequest->attributes();
	}
}