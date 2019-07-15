<?php

/**
 * @codeCoverageIgnore
 */
$factory->define(Collejo\App\Modules\Employees\Models\Employee::class, function (Faker\Generator $faker) {
    return [
        'employee_number' => $faker->numerify('S-##########'),
        'joined_on'       => $faker->date,
    ];
});
