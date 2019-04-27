<?php

/**
 * @codeCoverageIgnore
 */
$factory->define(Collejo\App\Modules\Employees\Models\EmployeeGrade::class, function (Faker\Generator $faker) {
    return [
        'name'                  => $faker->name,
        'code'                  => $faker->name,
        'priority'              => 1,
        'max_sessions_per_day'  => 1,
        'max_sessions_per_week' => 3,
    ];
});
