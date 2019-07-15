<?php

/**
 * @codeCoverageIgnore
 */
$factory->define(Collejo\App\Modules\ACL\Models\Permission::class, function (Faker\Generator $faker) {
    return [
        'module'           => 'test',
        'permission'       => $faker->randomLetter.$faker->time('H:i:s'),
    ];
});
