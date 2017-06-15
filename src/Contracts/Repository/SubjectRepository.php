<?php

namespace Collejo\App\Contracts\Repository;

interface SubjectRepository
{

    public function updateSubject(array $attributes, $id);

    public function createSubject(array $attributes);

    public function findSubject($id);

    public function getSubjects();
}