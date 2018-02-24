<?php

use Collejo\App\Contracts\Repository\UserRepository as UserRepositoryContract;
use Illuminate\Database\Migrations\Migration;

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

        $mainRoles = app()->majorUserRoles;

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
