<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Collejo\Core\Contracts\Repository\UserRepository as UserRepositoryContract;

class InsertMainRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $userRepository = app()->make(UserRepositoryContract::class);

        $mainRoles = ['admin', 'student', 'employee', 'guardian'];

        foreach ($mainRoles as $role) {
            $userRepository->createRoleIfNotExists($role);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
