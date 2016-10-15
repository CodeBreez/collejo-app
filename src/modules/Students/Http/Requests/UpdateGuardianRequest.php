<?php

namespace Collejo\App\Modules\Students\Http\Requests;

use Collejo\App\Http\Requests\Request;

class UpdateGuardianRequest extends Request
{

	public function rules()
	{
		$createRequest = new CreateGuardianRequest();

	    return array_merge(collect($createRequest->rules())->only('first_name', 'last_name', 'ssn')->toArray(), [
	    		'ssn' => 'required|unique:guardians,ssn,' . $this->get('gid')
	    	]);
	}

	public function attributes()
	{
		$createRequest = new CreateGuardianRequest();

		return $createRequest->attributes();
	}
}