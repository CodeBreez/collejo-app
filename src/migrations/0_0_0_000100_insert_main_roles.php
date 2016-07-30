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

        $mainRoles = [
            'admin' => 'Administrators have access to all features.',
            'student' => 'Students have access to limited features.',
            'employee' => 'Employees include teachers, assistants and the head of the institution.',
            'guardian' => 'Guardians have access to view their children\'s information.'
        ];

        foreach ($mainRoles as $role => $description) {
            $userRepository->createRoleIfNotExists($role, $description);
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
