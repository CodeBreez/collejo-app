<?php

namespace Collejo\App\Repository;

use Collejo\App\Foundation\Repository\BaseRepository;
use Collejo\App\Contracts\Repository\SubjectRepository as SubjectRepositoryContract;
use Collejo\App\Models\Subject;

class SubjectRepository extends BaseRepository implements SubjectRepositoryContract
{

    public function getSubjects()
    {
        return new Subject;
    }
}