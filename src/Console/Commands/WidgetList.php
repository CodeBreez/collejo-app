<?php

/**
 * Copyright (C) 2017 Anuradha Jauayathilaka <astroanu2004@gmail.com>
 */
namespace Collejo\App\Console\Commands;

use Illuminate\Console\Command;
use DirectoryIterator;
use Widget;

/**
 * Class WidgetList
 * @package Collejo\App\Console\Commands
 */
class WidgetList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'widget:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lists all loaded widgets';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->table(['Location', 'Permissions', 'View'], Widget::all()->toArray());
    }
}
