<?php

/**
 * @codeCoverageIgnore
 */
$factory->define(Collejo\App\Modules\Employees\Models\EmployeePosition::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});
