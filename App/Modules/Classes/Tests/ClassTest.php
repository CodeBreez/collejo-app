<?php

namespace Collejo\App\Modules\Classes\Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Collejo\App\Modules\Classes\Contracts\ClassRepository;
use Collejo\App\Modules\Classes\Models\Clasis;
use Collejo\App\Modules\Classes\Models\Grade;
use Collejo\Foundation\Tests\TestCase;
use Faker\Generator;

class ClassTest extends TestCase
{
    use DatabaseMigrations;

    private $classRepository;

    public function testClassCreate()
    {
        $class = factory(Clasis::class)->make();
        $grade = factory(Grade::class)->create();

        $model = $this->classRepository->createClass($class->toArray(), $grade->id);

        $this->assertArrayValuesEquals($model, $class);
    }

    public function testClassUpdate()
    {
        $grade = factory(Grade::class)->create();
        $class = factory(Clasis::class)->create(['grade_id' => $grade->id]);

        $classNew = factory(Clasis::class)->make();

        $model = $this->classRepository->updateClass($classNew->toArray(), $class->id, $class->grade->id);

        $this->assertArrayValuesEquals($model, $classNew);
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

        $this->factory->define(Clasis::class, function (Generator $faker) {
            return [
                'name' => $faker->firstName
            ];
        });
    }
}
