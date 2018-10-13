<?php

namespace Collejo\App\Modules\Students\Contracts;

interface StudentRepository
{
    public function updateStudent(array $attributes, $studentId);

    public function createStudent(array $attributes);

    public function getStudents();
}
