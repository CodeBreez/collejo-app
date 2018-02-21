<?php

namespace Collejo\Foundation\Database;

use Collejo\Foundation\Database\Eloquent\LoadFactories;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder as BaseSeeder;
use Faker\Generator;
use Uuid;

abstract class Seeder extends BaseSeeder
{
    use LoadFactories;

    public function __construct()
    {
        $this->faker = app()->make(Generator::class);

        $this->loadFactories();
    }

    public function createPivotIds($collection)
    {
        if (!$collection instanceof Collection) {
            $collection = collect($collection);
        }

        $ids = $collection->map(function () {
            return ['id' => (string) Uuid::generate(4)];
        });

        return array_combine(array_values($collection->toArray()), $ids->all());
    }
}
