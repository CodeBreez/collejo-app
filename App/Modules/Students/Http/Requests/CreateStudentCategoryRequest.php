<?php

namespace Collejo\App\Modules\Students\Http\Requests;

use Collejo\Foundation\Http\Requests\Request;

class CreateStudentCategoryRequest extends Request
{

	public function rules()
	{
	    return [
	        'name' => 'required|unique:student_categories',
	        'code' => 'unique:student_categories|max:5',
	    ];
	}

	public function attributes()
	{
		return [
	        'name' => trans('students::student_category.name'),
	        'code' => trans('students::student_category.code')
	    ];
	}
}