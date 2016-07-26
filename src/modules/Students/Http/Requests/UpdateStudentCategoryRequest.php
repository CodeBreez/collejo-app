<?php

namespace Collejo\App\Modules\Students\Http\Requests;

use Collejo\App\Http\Requests\Request;

class UpdateStudentCategoryRequest extends Request
{
	
	public function rules()
	{

		$createRequest = new CreateStudentCategoryRequest();

	    return array_merge($createRequest->rules(), [
	    		'name' => 'required|unique:student_categories,name,' . $this->get('scid'),
	    		'code' => 'required|max:5|unique:student_categories,code,' . $this->get('scid')
	    	]);
	}

	public function attributes()
	{
		$createRequest = new CreateStudentCategoryRequest();

	    return $createRequest->attributes();
	}
}