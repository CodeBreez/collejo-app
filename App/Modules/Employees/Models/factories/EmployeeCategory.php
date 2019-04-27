<?php

/**
 * @codeCoverageIgnore
 */
$factory->define(Collejo\App\Modules\Employees\Models\EmployeeCategory::class, function (Faker\Generator $faker) {
    return [
        'code' => $faker->firstName,
        'name' => $faker->name,
    ];
});
