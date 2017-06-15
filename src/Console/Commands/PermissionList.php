<?php

/**
 * Copyright (C) 2017 Anuradha Jauayathilaka <astroanu2004@gmail.com>
 */
namespace Collejo\App\Console\Commands;

use Illuminate\Console\Command;
use DirectoryIterator;
use Collejo\App\Contracts\Repository\UserRepository;

/**
 * Class PermissionList
 * @package Collejo\App\Console\Commands
 */
class PermissionList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:list {--module=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lists all available permissions';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $userRepository = app()->make(UserRepository::class);

        $module = $this->option('module');

        $userRepository = $userRepository->getPermissions();

        if (!is_null($module)) {
            $userRepository = $userRepository->where('module', $module);
        }

        $this->table(['Module', 'Permission'], $userRepository->orderBy('permission')->get(['module', 'permission']));
    }
}
