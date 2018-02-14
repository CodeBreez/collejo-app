<?php

namespace Collejo\Foundation\Database\Migrations;

use Illuminate\Database\Migrations\Migration as MigrationBase;
use Illuminate\Support\Facades\Schema;

class Migration extends MigrationBase
{

    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}