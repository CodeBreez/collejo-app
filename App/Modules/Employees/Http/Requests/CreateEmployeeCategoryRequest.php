<?php

namespace Collejo\App\Modules\Employees\Http\Requests;

use Collejo\Foundation\Http\Requests\Request;

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
	        'name' => trans('employees::employee_category.name'),
	        'code' => trans('employees::employee_category.code')
	    ];
	}
}