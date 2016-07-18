<?php

namespace Collejo\App\Modules\Students\Http\Requests;

use Collejo\App\Http\Requests\Request;

class UpdateStudentRequest extends Request
{

	public function rules()
	{
		$createRequest = new CreateEmployeeRequest();

	    return array_merge($createRequest->rules(), [
	    		'employee_number' => 'required|unique:employees,employee_number,' . $this->get('eid')
	    	]);
	}

	public function attributes()
	{
		$createRequest = new CreateEmployeeRequest();

		return $createRequest->attributes();
	}
}