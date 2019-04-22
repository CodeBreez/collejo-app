<?php

/**
 * @codeCoverageIgnore
 */
$factory->define(Collejo\App\Modules\Employees\Models\EmployeeDepartment::class, function (Faker\Generator $faker) {
    return [
        'code' => $faker->name,
        'name' => $faker->name
    ];
});
