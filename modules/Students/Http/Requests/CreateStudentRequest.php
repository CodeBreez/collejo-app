<?php

namespace Collejo\App\Modules\Students\Http\Requests;

use Collejo\App\Http\Requests\Request;

class CreateStudentRequest extends Request
{

	public function rules()
	{
	    return [
	        'admission_number' => 'required|unique:students',
	        'first_name' => 'required',
	        'last_name' => 'required'
	    ];
	}

	public function attributes()
	{
		return [
	        'admission_number' => 'Admission Number',
	        'first_name' => 'First Name',
	        'last_name' => 'Last Name'
	    ];
	}
}