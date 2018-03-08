<?php

namespace Collejo\App\Contracts\Repository;

interface StudentRepository
{
    public function updateStudentCategory(array $attributes, $studentCategoryId);

    public function createStudentCategory(array $attributes);

    public function findStudentCategory($studentCategoryId);

    public function removeGuardian($guardianId, $studentId);

    public function assignGuardian($guardianId, $studentId);

    public function assignToClass($batchId, $gradeId, $classId, $current, $studentId);

    public function deleteAddress($addressId, $studentId);

    public function updateAddress(array $attributes, $addressId, $studentId);

    public function createAddress(array $attributes, $studentId);

    public function findAddress($addressId, $studentId);

    public function findStudent($id);

    public function getStudents($criteria);

    public function updateStudent(array $attributes, $studentId);

    public function createStudent(array $attributes);

    public function getStudentCategories();

    public function boot();
}
