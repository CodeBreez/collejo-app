<?php

/**
 * @codeCoverageIgnore
 */
$factory->define(Collejo\App\Modules\ACL\Models\User::class, function (Faker\Generator $faker) {
    return [
        'email'          => $faker->safeEmail,
        'password'       => Hash::make('123'),
        'remember_token' => null,
        'date_of_birth'  => $faker->dateTimeThisDecade,
        'first_name'     => $faker->firstName,
        'last_name'      => $faker->lastName,
    ];
});
