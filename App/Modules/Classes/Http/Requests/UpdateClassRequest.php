<?php

namespace Collejo\App\Modules\Classes\Http\Requests;

use Collejo\Foundation\Http\Requests\Request;

class UpdateClassRequest extends Request
{

	public function rules()
	{

		$createRequest = new CreateClassRequest();

	    return $createRequest->rules();
	}

	public function attributes()
	{
		$createRequest = new CreateClassRequest();

	    return $createRequest->attributes();
	}
}