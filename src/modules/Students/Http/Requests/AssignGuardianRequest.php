<?php

namespace Collejo\App\Modules\Students\Http\Requests;

use Collejo\App\Http\Requests\Request;

class AssignGuardianRequest extends Request
{

	public function rules()
	{
	    return [
	        'student_id' => 'required',
	        'guardian_id' => 'required'
	    ];
	}

	public function attributes()
	{
		return [
	        'student_id' => 'Student',
	        'guardian_id' => 'Guardian'
	    ];
	}
}