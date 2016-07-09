<?php

namespace Collejo\App\Modules\Students\Http\Requests;

use Collejo\App\Http\Requests\Request;

class AssignClassRequest extends Request
{

	public function rules()
	{
	    return [
	        'class_id' => 'required',
	        'batch_id' => 'required'
	    ];
	}

	public function attributes()
	{
		return [
	        'class_id' => 'Class',
	        'batch_id' => 'Batch'
	    ];
	}
}