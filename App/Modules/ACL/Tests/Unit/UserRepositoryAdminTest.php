<?php

namespace Collejo\App\Modules\ACL\Tests\Unit;

use Auth;
use Collejo\App\Modules\ACL\Contracts\UserRepository;
use Collejo\App\Modules\ACL\Models\User;
use Collejo\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserRepositoryAdminTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    private $userRepository;

    /**
     * Test get admin users.
     */
    public function testGetAdminUsers()
    {
        $user = factory(User::class)->make();

        $model = $this->userRepository->createAdminUser($user->first_name, $user->email, '123');

        $adminUsers = $this->userRepository->getAdminUsers()->pluck('id')->toArray();

        $this->assertTrue(in_array($model->id, $adminUsers));
    }

    /**
     * Test creating an admin User.
     */
    public function testCreateAdminUser()
    {
        $user = factory(User::class)->make();

        $model = $this->userRepository->createAdminUser($user->first_name, $user->email, '123');

        $model->password = '123';

        $this->assertArrayValuesEquals($model, $user);
    }

    /**
     * Test if admin users can login.
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
