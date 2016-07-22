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
            'admin' => 'Administrator',
            'student' => 'Student',
            'employee' => 'Employee',
            'guardian' => 'Guardian'
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
