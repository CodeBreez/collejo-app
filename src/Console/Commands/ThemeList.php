<?php

/**
 * Copyright (C) 2017 Anuradha Jauayathilaka <astroanu2004@gmail.com>.
 */

namespace Collejo\App\Console\Commands;

use Illuminate\Console\Command;
use Theme;

/**
 * Class ThemeList.
 */
class ThemeList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'theme:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lists all loaded themes';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->table(['Name', 'Override Default'], Theme::all()->toArray());
    }
}
