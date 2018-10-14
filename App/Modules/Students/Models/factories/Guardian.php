<?php

/**
 * @codeCoverageIgnore
 */
$factory->define(Collejo\App\Modules\Students\Models\Guardian::class, function (Faker\Generator $faker) {
    return [
        'ssn' => 'G-' . $faker->randomNumber(8)
    ];
});