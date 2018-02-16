<?php

$factory->define(Collejo\App\Modules\ACL\Models\Role::class, function (Faker\Generator $faker) {
    return [
        'role'           => $faker->randomLetter.$faker->time('H:i:s'),
    ];
});
