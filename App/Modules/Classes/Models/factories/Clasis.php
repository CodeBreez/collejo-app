<?php

$factory->define(Collejo\App\Modules\Classes\Models\Clasis::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName
    ];
});