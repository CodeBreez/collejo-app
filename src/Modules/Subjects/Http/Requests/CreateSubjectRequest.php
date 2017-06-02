<?php

namespace Collejo\App\Modules\Subjects\Http\Requests;

use Collejo\App\Http\Requests\Request;

class CreateSubjectRequest extends Request
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
	        'name' => trans('subjects::subject.name'),
	    ];
	}
}