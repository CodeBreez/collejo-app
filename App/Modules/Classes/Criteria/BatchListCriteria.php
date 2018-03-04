<?php

namespace Collejo\App\Modules\Classes\Criteria;

use Collejo\Foundation\Criteria\BaseCriteria;
use Collejo\App\Modules\Classes\Models\Batch;

class BatchListCriteria extends BaseCriteria{

	protected $model = Batch::class;

	protected $criteria = [
			['name', '%LIKE%']
		];

	/*protected $selects = [
			'name' => 'batches.name'
		];*/

	/*protected $joins = [
			['users', 'students.user_id', 'users.id'],
			['class_student', 'students.id', 'class_student.student_id'],
			['batches', 'class_student.batch_id', 'batches.id'],
			['classes', 'class_student.class_id', 'classes.id']
		];*/

	/*protected $form = [
			'student_category' => [
				'type' => 'select',
				'itemsCallback' => 'studentCategories'
			],
			'batch' => [
				'type' => 'select',
				'itemsCallback' => 'batches'
			],
			'class' => [
				'type' => 'select',
				'itemsCallback' => 'classes'
			]
		];*/
}