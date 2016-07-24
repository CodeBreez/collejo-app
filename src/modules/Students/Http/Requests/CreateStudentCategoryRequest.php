<?php

namespace Collejo\App\Modules\Students\Http\Requests;

use Collejo\App\Http\Requests\Request;

class CreateStudentCategoryRequest extends Request
{

	public function rules()
	{
	    return [
	        'name' => 'required'
	    ];
	}

	public function attributes()
	{
		return [
	        'name' => 'Name'
	    ];
	}
}