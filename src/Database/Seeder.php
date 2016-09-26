<?php

namespace Collejo\App\Database;

use Illuminate\Database\Seeder as BaseSeeder;
use Illuminate\Database\Eloquent\Collection;
use Uuid;

abstract class Seeder extends BaseSeeder {

    public function createPrivotIds($collection)
	{
        if (!$collection instanceOf Collection) {
            $collection = collect($collection);
        }

		$ids = $collection->map(function(){
			return ['id' => (string) Uuid::generate(4)];
		});

		return array_combine(array_values($collection->toArray()), $ids->all());
	}

    public function __construct(\Faker\Generator $faker)
    {
        $this->faker = $faker;
    }
}