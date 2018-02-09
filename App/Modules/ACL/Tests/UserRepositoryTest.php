<?php

namespace Collejo\App\Modules\ACL\Tests;

use Auth;
use Collejo\App\Modules\ACL\Contracts\UserRepository;
use Collejo\App\Modules\ACL\Models\User;
use Collejo\Foundation\Tests\TestCase;
use Faker\Generator;
use Hash;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserRepositoryTest extends TestCase
{

    use DatabaseMigrations, DatabaseTransactions;

    private $userRepository;

    public function testUserCreate()
    {
        $user = factory(User::class)->make();

        $model = $this->userRepository->createAdminUser($user->first_name, $user->email, '123');

        $this->assertArrayValuesEquals($model, $user);
    }

    public function testUserLogin()
    {
        $user = factory(User::class)->make();

        $model = $this->userRepository->createAdminUser($user->first_name, $user->email, '123');

        $result = Auth::attempt(['email' => $user->email, 'password' => '123']);

        $this->assertTrue($result);
    }

    public function setup()
    {
        parent::setup();

        $this->userRepository = $this->app->make(UserRepository::class);

        $this->factory->define(User::class, function (Generator $faker) {
            return [
                'email' => $faker->safeEmail,
                'password' => Hash::make('123'),
                'remember_token' => null,
                'date_of_birth' => $faker->dateTimeThisDecade,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName
            ];
        });
    }
}