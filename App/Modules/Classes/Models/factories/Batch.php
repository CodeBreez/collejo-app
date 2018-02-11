<?php

$factory->define(Collejo\App\Modules\Classes\Models\Batch::class, function (Faker\Generator $faker) {
    return [
        'name' => 'batch ' . $faker->date
    ];
});