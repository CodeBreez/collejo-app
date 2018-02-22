<?php

namespace Collejo\App\Modules\Classes\Tests;

use Collejo\App\Modules\Classes\Contracts\ClassRepository;
use Collejo\App\Modules\Classes\Models\Batch;
use Collejo\App\Modules\Classes\Models\Term;
use Collejo\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TermTest extends TestCase
{
    use DatabaseMigrations;

    private $classRepository;

    public function testTermCreate()
    {
        $batch = factory(Batch::class)->create();
        $term = factory(Term::class)->make();

        $model = $this->classRepository->createTerm($term->toArray(), $batch->id);

        $this->assertArrayValuesEquals($model, $term);
    }

    public function testTermUpdate()
    {
        $batch = factory(Batch::class)->create();

        $term = factory(Term::class)->create(['batch_id' => $batch->id]);
        $termNew = factory(Term::class)->make();

        $model = $this->classRepository->updateTerm($termNew->toArray(), $term->id, $batch->id);

        $this->assertArrayValuesEquals($model, $termNew);
    }

    public function setup()
    {
        parent::setup();

        $this->classRepository = $this->app->make(ClassRepository::class);
    }
}
