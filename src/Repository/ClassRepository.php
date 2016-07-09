<?php

namespace Collejo\App\Repository;

use Collejo\Core\Foundation\Repository\BaseRepository;
use Collejo\Core\Contracts\Repository\ClassRepository as ClassRepositoryContract;
use Collejo\App\Models\Batch;
use Collejo\App\Models\Grade;
use Collejo\App\Models\Clasis;
use Collejo\App\Models\Term;
use DB;

class ClassRepository extends BaseRepository implements ClassRepositoryContract {

    public function deleteClass($classId, $gradeId)
    {
        $this->findClass($classId, $gradeId)->delete();
    }

    public function updateGrade(array $attributes, $id)
    {
        return $this->findGrade($id)->update($attributes);
    }

    public function findGrade($id)
    {
        return Grade::findOrFail($id);
    }

    public function createGrade(array $attributes)
    {
        return Grade::create($attributes);
    }

    public function getGrades()
    {
        return Grade::all();
    }

    public function updateClass(array $attributes, $classId, $gradeId)
    {
        $this->findClass($classId, $gradeId)->update($attributes);

        return $this->findClass($classId, $gradeId);
    }

    public function createClass(array $attributes, $gradeId)
    {
        $attributes['grade_id'] = $this->findGrade($gradeId)->id;

        return Clasis::create($attributes);
    }

    public function findClass($classId, $gradeId)
    {
        return Clasis::where(['grade_id' => $gradeId, 'id' => $classId])->firstOrFail();
    }

    public function getClasses()
    {
        return Clasis::all();
    }

    public function updateBatch(array $attributes, $batchId)
    {
        $this->findBatch($batchId)->update($attributes);

        return $this->findBatch($batchId);
    }

    public function deleteTerm($termId, $batchId)
    {
        $this->findTerm($termId, $batchId)->delete();
    }

    public function updateTerm(array $attributes, $termId, $batchId)
    {
        $attributes['start_date'] = $this->userTzConvert($attributes['start_date']);
        $attributes['end_date'] = $this->userTzConvert($attributes['end_date']);

        $this->findTerm($termId, $batchId)->update($attributes);

        return $this->findTerm($termId, $batchId);
    }

    public function findTerm($termId, $batchId)
    {
        return Term::where(['batch_id' => $batchId, 'id' => $termId])->firstOrFail();
    }

    public function createTerm(array $attributes, $batchId)
    {
        $term = null;

        $batch = $this->findBatch($batchId);

        $attributes['start_date'] = $this->userTzConvert($attributes['start_date']);
        $attributes['end_date'] = $this->userTzConvert($attributes['end_date']);
        $attributes['batch_id'] = $batch->id;

        DB::transaction(function () use ($attributes, &$term) {
            $term = Term::create($attributes);
        });

        return $term;
    }

    public function activeBatches()
    {
        return Batch::active();
    }

    public function findBatch($id)
    {
        return Batch::findOrFail($id);
    }

    public function createBatch(array $attributes)
    {
        return Batch::create($attributes);
    }

	public function getBatches()
	{
		return Batch::all();
	}

    function model()
    {
        return Batch::class;
    }

    public function boot()
    {
    	parent::boot();
    }
}