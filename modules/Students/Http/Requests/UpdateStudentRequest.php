<?php

namespace Collejo\App\Modules\Students\Http\Requests;

use Collejo\App\Http\Requests\Request;

class UpdateStudentRequest extends Request
{

	public function rules()
	{
		$createRequest = new CreateStudentRequest();

	    return array_merge($createRequest->rules(), [
	    		'admission_number' => 'required|unique:students,admission_number,' . $this->get('sid'),
	    		'email' => 'email|unique:users,email,' . $this->get('uid')
	    	]);
	}

	public function attributes()
	{
		$createRequest = new CreateStudentRequest();

		return $createRequest->attributes();
	}
}