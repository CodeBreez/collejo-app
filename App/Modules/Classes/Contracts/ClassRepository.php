<?php

namespace Collejo\App\Modules\Classes\Contracts;

use Collejo\App\Modules\Classes\Criteria\BatchListCriteria;

interface ClassRepository
{
    public function deleteClass($classId, $gradeId);

    public function updateGrade(array $attributes, $id);

    public function findGrade($id);

    public function createGrade(array $attributes);

    public function getGrades();

    public function updateClass(array $attributes, $classId, $gradeId);

    public function createClass(array $attributes, $gradeId);

    public function findClass($classId, $gradeId);

    public function getClasses();

    public function updateBatch(array $attributes, $batchId);

    public function deleteTerm($termId, $batchId);

    public function updateTerm(array $attributes, $termId, $batchId);

    public function findTerm($termId, $batchId);

    public function assignGradesToBatch(array $gradeIds, $batchId);

    public function createTerm(array $attributes, $batchId);

    public function activeBatches();

    public function findBatch($id, $with);

    public function createBatch(array $attributes);

    public function getBatches(BatchListCriteria $criteria);
}
