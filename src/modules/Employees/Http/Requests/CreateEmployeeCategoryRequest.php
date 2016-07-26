<?php

namespace Collejo\App\Modules\Employees\Http\Requests;

use Collejo\App\Http\Requests\Request;

class CreateEmployeeCategoryRequest extends Request
{

	public function rules()
	{
	    return [
	        'name' => 'required|unique:employee_categories',
	        'code' => 'unique:employee_categories|max:5',
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