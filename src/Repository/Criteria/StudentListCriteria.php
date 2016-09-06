<?php

namespace Collejo\App\Repository\Criteria;

use Collejo\Core\Foundation\Repository\BaseCriteria;
use DB;

class StudentListCriteria extends BaseCriteria{

	public function criteria()
	{
		return [
			['admission_number', '%LIKE%'],
			['student_category_id', '='],
			['name', '%LIKE%']
		];
	}

	public function selects()
	{
		return [
			'name' => 'CONCAT(users.first_name, \' \', users.last_name)'
		];
	}

	public function joins()
	{
		return [
			['users', 'students.user_id', 'users.id']
		];
	}
}