<?php

namespace Collejo\App\Modules\Employees\Http\Requests;

use Collejo\Foundation\Http\Requests\Request;

class UpdateEmployeeDetailsRequest extends Request
{

	public function rules()
	{
		$createRequest = new CreateEmployeeDetailsRequest();

	    return array_merge($createRequest->rules(), [
	    		'employee_number' => 'required|unique:employees,employee_number,' . $this->json('id')
	    	]);
	}

	public function attributes()
	{
		$createRequest = new CreateEmployeeDetailsRequest();

		return $createRequest->attributes();
	}
}