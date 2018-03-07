<?php

namespace Collejo\App\Repository;

use Collejo\App\Contracts\Repository\SubjectRepository as SubjectRepositoryContract;
use Collejo\App\Foundation\Repository\BaseRepository;
use Collejo\App\Models\Subject;

class SubjectRepository extends BaseRepository implements SubjectRepositoryContract
{
    public function updateSubject(array $attributes, $id)
    {
        $this->findSubject($id)->update($attributes);

        return $this->findSubject($id);
    }

    public function createSubject(array $attributes)
    {
        return Subject::create($attributes);
    }

    public function findSubject($id)
    {
        return Subject::findOrFail($id);
    }

    public function getSubjects()
    {
        return new Subject();
    }
}
