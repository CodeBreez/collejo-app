<?php

namespace Collejo\App\Modules\Students\Repositories;

use Collejo\App\Modules\ACL\Contracts\UserRepository;
use Collejo\App\Modules\Classes\Contracts\ClassRepository;
use Collejo\App\Modules\Students\Contracts\StudentRepository as StudentRepositoryContract;
use Collejo\App\Modules\Students\Criteria\StudentListCriteria;
use Collejo\App\Modules\Students\Models\Student;
use Collejo\App\Modules\Students\Models\StudentCategory;
use Collejo\Foundation\Repository\BaseRepository;
use DB;

class StudentRepository extends BaseRepository implements StudentRepositoryContract
{
    protected $userRepository;

    protected $classRepository;

    /**
     * Returns a collection of student categories.
     *
     * @return \Collejo\Foundation\Repository\CacheableResult
     */
    public function getStudentCategories()
    {
        return $this->search(StudentCategory::class);
    }

    /**
     * Returns or fails finding a Student by the id.
     *
     * @param $id
     *
     * @return mixed
     */
    public function findStudent($id)
    {
        return Student::findOrFail($id);
    }

    public function findStudentCategory($studentCategoryId)
    {
        return StudentCategory::findOrFail($studentCategoryId);
    }

    public function assignStudentCategory($studentCategoryId, $studentId)
    {
        $this->findStudent($studentId)->studentCategory()->save($this->findStudentCategory($studentCategoryId));
    }

    /**
     * Updates the given Student and the User with the given attributes.
     *
     * @param array $attributes
     * @param $studentId
     *
     * @return mixed
     */
    public function updateStudent(array $attributes, $studentId)
    {
        $student = $this->findStudent($studentId);

        if (isset($attributes['admitted_on'])) {
            $attributes['admitted_on'] = toUTC($attributes['admitted_on']);
        }

        if (!isset($attributes['image_id'])) {
            $attributes['image_id'] = null;
        }

        $studentAttributes = $this->parseFillable($attributes, Student::class);

        DB::transaction(function () use ($attributes, $studentAttributes, &$student, $studentId) {
            $student->update($studentAttributes);

            $user = $this->userRepository->update($attributes, $student->user->id);
        });

        return $student;
    }

    /**
     * Creates a new Student and User model with the given attributes.
     *
     * @param array $attributes
     *
     * @return null
     */
    public function createStudent(array $attributes)
    {
        $student = null;

        $attributes['admitted_on'] = toUTC($attributes['admitted_on']);

        if (!isset($attributes['image_id'])) {
            $attributes['image_id'] = null;
        }

        $studentAttributes = $this->parseFillable($attributes, Student::class);

        DB::transaction(function () use ($attributes, $studentAttributes, &$student) {
            $user = $this->userRepository->create($attributes);

            $student = Student::make($studentAttributes);

            $student->user()->associate($user)->save();

            $this->userRepository->addRoleToUser($user, $this->userRepository->getRoleByName('student'));
        });

        return $student;
    }

    /**
     * Search for users bases on the criteria.
     *
     * @param $criteria
     *
     * @return \Collejo\Foundation\Repository\CacheableResult
     */
    public function getStudents(StudentListCriteria $criteria)
    {
        return $this->search($criteria);
    }

    /**
     * Setup additional repositories.
     */
    public function boot()
    {
        parent::boot();

        $this->userRepository = app()->make(UserRepository::class);
        $this->classRepository = app()->make(ClassRepository::class);
    }
}
