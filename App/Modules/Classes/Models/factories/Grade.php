<?php

$factory->define(Collejo\App\Modules\Classes\Models\Grade::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
    ];
});
