<?php

/**
 * @codeCoverageIgnore
 */
$factory->define(Collejo\App\Modules\Students\Models\Student::class, function (Faker\Generator $faker) {
    return [
        'admission_number' => $faker->numerify('S-##########'),
        'admitted_on' => $faker->date
    ];
});
