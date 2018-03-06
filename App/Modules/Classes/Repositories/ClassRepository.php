<?php

namespace Collejo\App\Modules\Classes\Repository;

use Collejo\App\Modules\Classes\Contracts\ClassRepository as ClassRepositoryContract;
use Collejo\App\Modules\Classes\Criteria\BatchListCriteria;
use Collejo\App\Modules\Classes\Models\Batch;
use Collejo\App\Modules\Classes\Models\Clasis;
use Collejo\App\Modules\Classes\Models\Grade;
use Collejo\App\Modules\Classes\Models\Term;
use Collejo\Foundation\Repository\BaseRepository;

class ClassRepository extends BaseRepository implements ClassRepositoryContract
{
    /**
     * Deletes a given class by class id for the given grade id.
     *
     * @param $classId
     * @param $gradeId
     */
    public function deleteClass($classId, $gradeId)
    {
        $this->findClass($classId, $gradeId)->delete();
    }

    /**
     * Update the given Grade with attributes.
     *
     * @param array $attributes
     * @param $id
     *
     * @return mixed
     */
    public function updateGrade(array $attributes, $id)
    {
        $this->findGrade($id)->update($attributes);

        return $this->findGrade($id);
    }

    /**
     * Find Grade by id.
     *
     * @param $id
     *
     * @return mixed
     */
    public function findGrade($id)
    {
        return Grade::findOrFail($id);
    }

    /**
     * Create new Grade with given attributes.
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function createGrade(array $attributes)
    {
        return Grade::create($attributes);
    }

    /**
     * Returns a collection of Grades.
     *
     * @return \Collejo\Foundation\Repository\CacheableResult
     */
    public function getGrades()
    {
        return $this->search(Grade::class);
    }

    /**
     * Update a Class with given attributes for the given grade id.
     *
     * @param array $attributes
     * @param $classId
     * @param $gradeId
     *
     * @return mixed
     */
    public function updateClass(array $attributes, $classId, $gradeId)
    {
        $this->findClass($classId, $gradeId)->update($attributes);

        return $this->findClass($classId, $gradeId);
    }

    /**
     * Creates a new Class with given attributes for the given grade id.
     *
     * @param array $attributes
     * @param $gradeId
     *
     * @return mixed
     */
    public function createClass(array $attributes, $gradeId)
    {
        $attributes['grade_id'] = $this->findGrade($gradeId)->id;

        return Clasis::create($attributes);
    }

    /**
     * Find a class by id for the given grade id.
     *
     * @param $classId
     * @param $gradeId
     *
     * @return mixed
     */
    public function findClass($classId, $gradeId)
    {
        return Clasis::where(['grade_id' => $gradeId, 'id' => $classId])->firstOrFail();
    }

    /**
     * Returns a collection of Classes.
     *
     * @return \Collejo\Foundation\Repository\CacheableResult
     */
    public function getClasses()
    {
        return $this->search(Clasis::class);
    }

    /**
     * Update a Batch with given attributes.
     *
     * @param array $attributes
     * @param $batchId
     *
     * @return mixed
     */
    public function updateBatch(array $attributes, $batchId)
    {
        $this->findBatch($batchId)->update($attributes);

        return $this->findBatch($batchId);
    }

    /**
     * Deletes a Term by id for the given batch id.
     *
     * @param $termId
     * @param $batchId
     */
    public function deleteTerm($termId, $batchId)
    {
        $this->findTerm($termId, $batchId)->delete();
    }

    /**
     * Update a term with attributes for the term id for batch id.
     *
     * @param array $attributes
     * @param $termId
     * @param $batchId
     *
     * @return mixed
     */
    public function updateTerm(array $attributes, $termId, $batchId)
    {
        $this->findTerm($termId, $batchId)->update($attributes);

        return $this->findTerm($termId, $batchId);
    }

    /**
     * Find a Term by id.
     *
     * @param $termId
     * @param $batchId
     *
     * @return mixed
     */
    public function findTerm($termId, $batchId)
    {
        return Term::where(['batch_id' => $batchId, 'id' => $termId])->firstOrFail();
    }

    /**
     * Assign an array of grade ids to the given Batch.
     *
     * @param array $gradeIds
     * @param $batchId
     */
    public function assignGradesToBatch(array $gradeIds, $batchId)
    {
        $this->findBatch($batchId)->grades()->sync($this->createPivotIds($gradeIds));
    }

    /**
     * Create a new Term with given attributes.
     *
     * @param array $attributes
     * @param $batchId
     *
     * @return mixed
     */
    public function createTerm(array $attributes, $batchId)
    {
        $batch = $this->findBatch($batchId);

        $attributes['start_date'] = toUTC($attributes['start_date']);
        $attributes['end_date'] = toUTC($attributes['end_date']);
        $attributes['batch_id'] = $batch->id;

        return Term::create($attributes);
    }

    /**
     * Return a collection of active Batches.
     *
     * @return mixed
     */
    public function activeBatches()
    {
        return Batch::active();
    }

    /**
     * Find a Batch by id.
     *
     * @param $id
     * @param $with
     *
     * @return mixed
     */
    public function findBatch($id, $with = null)
    {
        if ($with) {
            return Batch::with($with)->findOrFail($id);
        }

        return Batch::findOrFail($id);
    }

    /**
     * Create a new Batch with given attributes.
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function createBatch(array $attributes)
    {
        return Batch::create($attributes);
    }

    /**
     * Return a collection of Batches.
     *
     * @return \Collejo\Foundation\Repository\CacheableResult
     */
    public function getBatches(BatchListCriteria $criteria)
    {
        return $this->search($criteria)->orderBy('start_date');
    }
}
