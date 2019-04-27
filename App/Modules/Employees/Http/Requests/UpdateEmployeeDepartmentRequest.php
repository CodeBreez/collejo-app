<?php

namespace Collejo\App\Modules\Employees\Http\Requests;

use Collejo\Foundation\Http\Requests\Request;

class UpdateEmployeeDepartmentRequest extends Request
{

	public function rules()
	{
		$createRequest = new CreateEmployeeDepartmentRequest();

	    return array_merge($createRequest->rules(), [
	    		'name' => 'required|unique:employee_departments,name,' . $this->json('id'),
	        	'code' => 'max:5|unique:employee_departments,code,' . $this->json('id'),
	    	]);
	}

	public function attributes()
	{
		$createRequest = new CreateEmployeeDepartmentRequest();

		return $createRequest->attributes();
	}
}