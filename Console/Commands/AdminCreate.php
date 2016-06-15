<?php

namespace Collejo\App\Console\Commands;

use Illuminate\Console\Command;
use Collejo\Core\Contracts\Repository\UserRepository;

class AdminCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a user account and assigns administrative roles';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(UserRepository $userRepository)
    {
        $name = $this->ask('Enter administrator name');
        $email = $this->ask('Enter email');
        $password = $this->secret('Enter password');

        $userRepository->createAdminUser();
    }
}
