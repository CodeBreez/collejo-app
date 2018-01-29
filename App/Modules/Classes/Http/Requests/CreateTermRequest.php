<?php

namespace Collejo\App\Modules\Classes\Http\Requests;

use Collejo\Foundation\Http\Requests\Request;

class CreateTermRequest extends Request
{

	public function rules()
	{
	    return [
	        'name' => 'required',
	        'start_date' => 'required',
	        'end_date' => 'required'
	    ];
	}

	public function attributes()
	{
		return [
	        'name' => 'Term Name',
	        'start_date' => 'Start Date',
	        'end_date' => 'End Date',
	    ];
	}
}