<?php

namespace Collejo\App\Modules\Students\Http\Requests;

use Collejo\Foundation\Http\Requests\Request;

class CreateGuardianRequest extends Request
{

	public function rules()
	{
	    return [
	        'first_name' => 'required',
	        'last_name' => 'required',
	        'ssn' => 'required|unique:guardians,ssn',
	    ];
	}

	public function attributes()
	{
		return [
	        'first_name' => trans('students::guardian.first_name'),
	        'last_name' => trans('students::guardian.last_name'),
	        'ssn' => trans('students::guardian.ssn'),
	    ];
	}
}