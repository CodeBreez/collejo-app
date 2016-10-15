<?php

namespace Collejo\App\Modules\Students\Http\Requests;

use Collejo\App\Http\Requests\Request;

class CreateAddressRequest extends Request
{

	public function rules()
	{
	    return [
	        'full_name' => 'required',
	        'address' => 'required'
	    ];
	}

	public function attributes()
	{
		return [
	        'full_name' => trans('student::address.full_name'),
	        'address' => trans('student::address.address'),
	        'city' => trans('student::address.city'),
	        'postal_code' => trans('student::address.postal_code'),
	        'phone' => trans('student::address.phone'),
	        'note' => trans('student::address.note'),
	    ];
	}
}