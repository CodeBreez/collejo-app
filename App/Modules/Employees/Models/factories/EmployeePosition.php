<?php

/**
 * @codeCoverageIgnore
 */
$factory->define(Collejo\App\Modules\Employees\Models\EmployeePosition::class, function (Faker\Generator $faker) {
    return [
        'employee_category_id' => $faker->randomElement(Collejo\App\Modules\Employees\Models\EmployeeCategory::all()->lists('id')->toArray()),
        'name' => $faker->name
    ];
});
