<?php

namespace Collejo\App\Modules\Classes\Tests;

use Collejo\App\Modules\Classes\Contracts\ClassRepository;
use Collejo\App\Modules\Classes\Models\Grade;
use Collejo\Foundation\Tests\TestCase;
use Faker\Generator;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class GradeTest extends TestCase
{
    use DatabaseMigrations;

    private $classRepository;

    public function testGradeCreate()
    {
        $grade = factory(Grade::class)->make();

        $model = $this->classRepository->createGrade($grade->toArray());

        $this->assertArrayValuesEquals($model, $grade);
    }

    public function testGradeUpdate()
    {
        $grade = factory(Grade::class)->create();

        $gradeNew = factory(Grade::class)->make();

        $model = $this->classRepository->updateGrade($gradeNew->toArray(), $grade->id);

        $this->assertArrayValuesEquals($model, $gradeNew);
    }

    public function setup()
    {
        parent::setup();

        $this->classRepository = $this->app->make(ClassRepository::class);

        $this->factory->define(Grade::class, function (Generator $faker) {
            return [
                'name' => $faker->firstName
            ];
        });
    }
}
