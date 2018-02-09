<?php

namespace Collejo\App\Modules\Classes\Tests;

use Collejo\App\Modules\Classes\Contracts\ClassRepository;
use Collejo\App\Modules\Classes\Models\Batch;
use Collejo\Foundation\Tests\TestCase;
use Faker\Generator;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BatchTest extends TestCase
{
    use DatabaseMigrations;

    private $classRepository;

    public function testBatchCreate()
    {
        $batch = factory(Batch::class)->create();

        $model = $this->classRepository->createBatch($batch->toArray());

        $this->assertArrayValuesEquals($model, $batch);
    }

    public function testBatchUpdate()
    {
        $batch = factory(Batch::class)->create();
        $batchNew = factory(Batch::class)->make();

        $model = $this->classRepository->updateBatch($batchNew->toArray(), $batch->id);

        $this->assertArrayValuesEquals($model, $batchNew);
    }

    public function setup()
    {
        parent::setup();

        $this->classRepository = $this->app->make(ClassRepository::class);

        $this->factory->define(Batch::class, function (Generator $faker) {
            return [
                'name' => 'batch ' . $faker->date
            ];
        });
    }
}
