<?php

namespace Collejo\App\Modules\Students\Contracts;

use Collejo\App\Modules\Students\Criteria\StudentListCriteria;

interface StudentRepository
{
    public function updateStudent(array $attributes, $studentId);

    public function createStudent(array $attributes);

    public function getStudents(StudentListCriteria $criteria);
}
