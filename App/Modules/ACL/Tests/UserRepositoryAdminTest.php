<?php

namespace Collejo\App\Modules\ACL\Tests;

use Auth;
use Collejo\App\Modules\ACL\Contracts\UserRepository;
use Collejo\App\Modules\ACL\Models\User;
use Collejo\Foundation\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserRepositoryAdminTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    private $userRepository;

    /**
     * @covers \Collejo\App\Modules\ACL\Contracts\UserRepository::getAdminUsers()
     * @covers \Collejo\App\Modules\ACL\Contracts\UserRepository::createAdminUser()
     */
    public function testGetAdminUsers()
    {
        $user = factory(User::class)->make();

        $model = $this->userRepository->createAdminUser($user->first_name, $user->email, '123');

        $adminUsers = $this->userRepository->getAdminUsers()->pluck('id')->toArray();

        $this->assertTrue(in_array($model->id, $adminUsers));
    }

    /**
     * @covers \Collejo\App\Modules\ACL\Contracts\UserRepository::createAdminUser()
     */
    public function testCreateAdminUser()
    {
        $user = factory(User::class)->make();

        $model = $this->userRepository->createAdminUser($user->first_name, $user->email, '123');

        $this->assertArrayValuesEquals($model, $user);
    }

    /**
     * @covers Auth::attempt()
     * @covers \Collejo\App\Modules\ACL\Contracts\UserRepository::createAdminUser()
     */
    public function testAdminUserLogin()
    {
        $user = factory(User::class)->make();

        $this->userRepository->createAdminUser($user->first_name, $user->email, '123');

        $result = Auth::attempt(['email' => $user->email, 'password' => '123']);

        $this->assertTrue($result);
    }

    public function setup()
    {
        parent::setup();

        $this->userRepository = $this->app->make(UserRepository::class);
    }
}
