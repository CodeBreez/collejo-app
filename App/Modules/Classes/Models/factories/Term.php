<?php

/**
 * @codeCoverageIgnore
 */
$factory->define(Collejo\App\Modules\Classes\Models\Term::class, function (Faker\Generator $faker) {
    return [
        'name'       => $faker->name,
        'start_date' => $faker->dateTimeThisYear,
        'end_date'   => $faker->dateTimeThisYear,
    ];
});
