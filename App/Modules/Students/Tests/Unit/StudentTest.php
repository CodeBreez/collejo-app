<?php

namespace Collejo\App\Modules\Students\Tests\Unit;

use Collejo\App\Modules\Students\Contracts\StudentRepository;
use Collejo\App\Modules\Students\Models\Student;
use Collejo\App\Modules\ACL\Models\User;
use Collejo\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class StudentTest extends TestCase
{
    use DatabaseMigrations;

    private $studentRepository;

    /**
     * Test creating a Student.
     */
    public function testStudentCreate()
    {
        $student = factory(Student::class)->make();
        $user = factory(User::class)->make();

        $inputData = array_merge($student->toArray(), $user->toArray());

        $model = $this->studentRepository->createStudent($inputData);

        $this->assertArrayValuesEquals($model, $student);
    }

    /**
     * Test updating a Student.
     */
    public function testStudentUpdate()
    {
        $user = factory(User::class)->create();

        $student = factory(Student::class)->create();

        $student->user()->associate($user)->save();

        $studentNew = factory(Student::class)->make();
        $userNew = factory(User::class)->make();

        $inputData = array_merge($studentNew->toArray(), $userNew->toArray());

        $model = $this->studentRepository->updateStudent($inputData, $student->id);

        $this->assertArrayValuesEquals($model, $studentNew);
    }

    public function setup()
    {
        parent::setup();

        $this->studentRepository = $this->app->make(StudentRepository::class);
    }
}
