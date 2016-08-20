<?php

namespace Collejo\App\Modules\Students\Http\Requests;

use Collejo\App\Http\Requests\Request;

class CreateStudentRequest extends Request
{

	public function rules()
	{
	    return [
	        'admission_number' => 'required|unique:students',
	        'admitted_on' => 'required',
	        'student_category_id' => 'required',
	        'first_name' => 'required',
	        'last_name' => 'required',
	        'date_of_birth' => 'required'
	    ];
	}

	public function attributes()
	{
		return [
	        'admission_number' => 'Admission Number',
	        'admitted_on' => 'Admission Date',
	        'student_category_id' => 'Student Category',
	        'first_name' => 'First Name',
	        'last_name' => 'Last Name',
	        'date_of_birth' => 'Date of Birth'
	    ];
	}
}