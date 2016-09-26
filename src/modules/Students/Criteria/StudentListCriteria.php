<?php

namespace Collejo\App\Modules\Students\Criteria;

use Collejo\App\Foundation\Repository\BaseCriteria;
use Collejo\App\Models\Student;
use Collejo\App\Contracts\Repository\StudentRepository;

class StudentListCriteria extends BaseCriteria{

	protected $model = Student::class;

	protected $criteria = [
			['student_category_id', '=', 'student_category'],
			['admission_number', '%LIKE%'],
			['name', '%LIKE%']
		];

	protected $selects = [
			'name' => 'CONCAT(users.first_name, \' \', users.last_name)'
		];

	protected $joins = [
			['users', 'students.user_id', 'users.id']
		];

	protected $form = [
			'student_category' => [
				'type' => 'select',
				'itemsCallback' => 'studentCategories'
			]
		];

	public function callbackStudentCategories()
	{
		return app()->make(StudentRepository::class)->getStudentCategories()->get();
	}		
}