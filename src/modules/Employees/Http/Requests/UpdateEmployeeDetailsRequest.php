<?php

namespace Collejo\App\Modules\Students\Http\Requests;

use Collejo\App\Http\Requests\Request;

class UpdateEmployeeDetailsRequest extends Request
{

	public function rules()
	{
		$createRequest = new CreateEmployeeDetailsRequest();

	    return array_merge($createRequest->rules(), [
	    		'employee_number' => 'required|unique:employees,employee_number,' . $this->get('eid')
	    	]);
	}

	public function attributes()
	{
		$createRequest = new CreateEmployeeDetailsRequest();

		return $createRequest->attributes();
	}
}