<?php

namespace Collejo\App\Modules\Students\Http\Requests;

use Collejo\App\Http\Requests\Request;

class CreateGuardianRequest extends Request
{

	public function rules()
	{
	    return [
	        'first_name' => 'required',
	        'last_name' => 'required',
	        'ssn' => 'required|unique:guardians,ssn',
	        'email' => 'email|unique:users,email',
			'full_name' => 'required',
			'address' => 'required',
			'city' => 'required',
			'phone' => 'required'
	    ];
	}

	public function attributes()
	{
		return [
	        'first_name' => trans('students::guardian.first_name'),
	        'last_name' => trans('students::guardian.last_name'),
	        'ssn' => trans('students::guardian.ssn'),
	        'email' => trans('students::guardian.email'),
			'full_name' => trans('students::address.name'),
			'address' => trans('students::address.address'),
			'city' => trans('students::address.city'),
			'postal_code' => trans('students::address.postal_code'),
			'phone' => trans('students::address.phone'),
			'notes' => trans('students::address.notes'),
	    ];
	}
}