<?php

/**
 * @codeCoverageIgnore
 */
$factory->define(Collejo\App\Modules\Students\Models\StudentCategory::class, function (Faker\Generator $faker) {
    return [
        'code' => $faker->firstName,
        'name' => $faker->name
    ];
});