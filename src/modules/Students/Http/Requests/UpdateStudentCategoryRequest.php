<?php

namespace Collejo\App\Modules\Students\Http\Requests;

use Collejo\App\Http\Requests\Request;

class UpdateStudentCategoryRequest extends Request
{
	
	public function rules()
	{

		$createRequest = new CreateStudentCategoryRequest();

	    return $createRequest->rules();
	}

	public function attributes()
	{
		$createRequest = new CreateStudentCategoryRequest();

	    return $createRequest->attributes();
	}
}