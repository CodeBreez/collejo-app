<?php

namespace Collejo\App\Modules\Students\Http\Requests;

use Collejo\App\Http\Requests\Request;

class UpdateAddressRequest extends Request
{

	public function rules()
	{

		$createRequest = new CreateAddressRequest();

	    return $createRequest->rules();
	}

	public function attributes()
	{
		$createRequest = new CreateAddressRequest();

	    return $createRequest->attributes();
	}
}