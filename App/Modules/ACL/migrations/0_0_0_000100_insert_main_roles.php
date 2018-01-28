<?php

use Illuminate\Database\Migrations\Migration;
use Collejo\App\Modules\ACL\Contracts\UserRepository as UserRepositoryContract;

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
