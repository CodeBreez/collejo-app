<?php

namespace Collejo\App\Modules\Classes\Tests\Unit;

use Collejo\App\Modules\Classes\Contracts\ClassRepository;
use Collejo\App\Modules\Classes\Criteria\BatchListCriteria;
use Collejo\App\Modules\Classes\Models\Batch;
use Collejo\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BatchTest extends TestCase
{
    use DatabaseMigrations;

    private $classRepository;

    /**
     * Test Getting batches list.
     */
    public function testGetBatches()
    {
        factory(Batch::class, 5)->create();

        $batches = $this->classRepository
            ->getBatches(app()->make(BatchListCriteria::class))->get();

        $this->assertCount(5, $batches);
    }

    /**
     * Test creating a Batch.
     */
    public function testBatchCreate()
    {
        $batch = factory(Batch::class)->make();

        $model = $this->classRepository->createBatch($batch->toArray());

        $this->assertArrayValuesEquals($model, $batch);
    }

    /**
     * Test updating a Batch.
     */
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
    }
}
