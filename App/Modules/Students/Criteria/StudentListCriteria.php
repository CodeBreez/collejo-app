<?php

namespace Collejo\App\Modules\Students\Criteria;

use Collejo\App\Modules\Classes\Contracts\ClassRepository;
use Collejo\App\Modules\Students\Contracts\StudentRepository;
use Collejo\App\Modules\Students\Models\Student;
use Collejo\Foundation\Criteria\BaseCriteria;

class StudentListCriteria extends BaseCriteria
{
    protected $model = Student::class;

    protected $criteria = [
        ['admission_number', '%LIKE%'],
        ['name', '%LIKE%'],
        ['batch_id', '=', 'batch'],
        ['class_id', '=', 'class'],
        ['student_category_id', '=', 'student_category'],
    ];

    protected $selects = [
        'name'     => 'CONCAT(users.first_name, \' \', users.last_name)',
        'batch_id' => 'batches.id',
        'class_id' => 'classes.id',
    ];

    protected $joins = [
        ['users', 'students.user_id', 'users.id'],
        ['class_student', 'students.id', 'class_student.student_id'],
        ['batches', 'class_student.batch_id', 'batches.id'],
        ['classes', 'class_student.class_id', 'classes.id'],
    ];

    protected $form = [
        'student_category' => [
            'type'          => 'select',
            'itemsCallback' => 'studentCategories',
        ],
        'batch' => [
            'type'          => 'select',
            'itemsCallback' => 'batches',
        ],
        'class' => [
            'type'          => 'select',
            'itemsCallback' => 'classes',
        ],
    ];

    public function callbackStudentCategories()
    {
        return app()->make(StudentRepository::class)->getStudentCategories()->get();
    }

    public function callbackBatches()
    {
        return app()->make(ClassRepository::class)->activeBatches()->get();
    }

    public function callbackClasses()
    {
        return app()->make(ClassRepository::class)->getClasses()->get();
    }
}
