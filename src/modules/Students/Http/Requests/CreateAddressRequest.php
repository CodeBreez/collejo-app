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
	        'full_name' => 'Contact Person Name',
	        'address' => 'Address',
	        'city' => 'City',
	        'postal_code' => 'Postal Code',
	        'phone' => 'Phone',
	        'note	' => 'Note'
	    ];
	}
}