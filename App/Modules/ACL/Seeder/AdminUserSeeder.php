<?php

namespace Collejo\App\Modules\ACL\Seeder;

use Collejo\App\Modules\ACL\Models\User;
use Collejo\Foundation\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 5)->create();
    }
}
