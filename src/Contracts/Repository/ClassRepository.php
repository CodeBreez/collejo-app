<?php

/**
 * Copyright (C) 2017 Anuradha Jauayathilaka <astroanu2004@gmail.com>.
 */

namespace Collejo\App\Contracts\Repository;

use Collejo\App\Models\Batch;
use Collejo\App\Models\Clasis;
use Collejo\App\Models\Grade;
use Collejo\App\Models\Term;
use Illuminate\Support\Collection;

/**
 * Interface ClassRepository.
 */
interface ClassRepository
{
    /**
     * Delete a class.
     *
     * @param $classId
     * @param $gradeId
     *
     * @return bool
     */
    public function deleteClass($classId, $gradeId);

    /**
     * Update a Grade with given attributes.
     *
     * @param array $attributes
     * @param $id
     *
     * @return bool
     */
    public function updateGrade(array $attributes, $id);

    /**
     * Find a Grade by id.
     *
     * @param $id
     *
     * @return Grade
     */
    public function findGrade($id);

    /**
     * Create a new grade.
     *
     * @param array $attributes
     *
     * @return Grade
     */
    public function createGrade(array $attributes);

    /**
     * Get a list of grades.
     *
     * @return Collection
     */
    public function getGrades();

    /**
     * Update a class with given attributes.
     *
     * @param array $attributes
     * @param $classId
     * @param $gradeId
     *
     * @return bool
     */
    public function updateClass(array $attributes, $classId, $gradeId);

    /**
     * Create a new class.
     *
     * @param array $attributes
     * @param $gradeId
     *
     * @return Clasis
     */
    public function createClass(array $attributes, $gradeId);

    /**
     * Find a class by it's id.
     *
     * @param $classId
     * @param $gradeId
     *
     * @return Clasis
     */
    public function findClass($classId, $gradeId);

    /**
     * Get a lsit of classes.
     *
     * @return Clasis
     */
    public function getClasses();

    /**
     * Update a batch.
     *
     * @param array $attributes
     * @param $batchId
     *
     * @return Collection
     */
    public function updateBatch(array $attributes, $batchId);

    /**
     * Delete a term.
     *
     * @param $termId
     * @param $batchId
     *
     * @return bool
     */
    public function deleteTerm($termId, $batchId);

    /**
     * Update a term with given attributes.
     *
     * @param array $attributes
     * @param $termId
     * @param $batchId
     *
     * @return bool
     */
    public function updateTerm(array $attributes, $termId, $batchId);

    /**
     * Find a term by id.
     *
     * @param $termId
     * @param $batchId
     *
     * @return Term
     */
    public function findTerm($termId, $batchId);

    /**
     * Assign a set of grades to a batch.
     *
     * @param array $gradeIds
     * @param $batchId
     *
     * @return bool
     */
    public function assignGradesToBatch(array $gradeIds, $batchId);

    /**
     * Create a new term.
     *
     * @param array $attributes
     * @param $batchId
     *
     * @return Term
     */
    public function createTerm(array $attributes, $batchId);

    /**
     * Get a list of active batches.
     *
     * @return Collection
     */
    public function activeBatches();

    /**
     * Get a batch by it's id.
     *
     * @param $id
     *
     * @return Batch
     */
    public function findBatch($id);

    /**
     * Create new Batch.
     *
     * @param array $attributes
     *
     * @return Batch
     */
    public function createBatch(array $attributes);

    /**
     * Get a list of batches.
     *
     * @return Collection
     */
    public function getBatches();
}
