<?php

/**
 * @codeCoverageIgnore
 */
$factory->define(Collejo\App\Modules\ACL\Models\Address::class, function (Faker\Generator $faker) {
    return [
        'full_name'   => $faker->name,
        'user_id'     => $faker->name,
        'address'     => $faker->address,
        'city'        => $faker->city,
        'postal_code' => $faker->zip,
        'phone'       => $faker->phone,
    ];
});
