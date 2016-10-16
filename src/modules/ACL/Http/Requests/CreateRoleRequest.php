<?php

namespace Collejo\App\Modules\ACL\Http\Requests;

use Collejo\App\Http\Requests\Request;

class CreateRoleRequest extends Request
{

	public function rules()
	{
	    return [
	        'role' => 'required|unique:roles|max:20',
	    ];
	}

	public function attributes()
	{
		return [
	        'role' => trans('acl::role.name'),
	    ];
	}
}