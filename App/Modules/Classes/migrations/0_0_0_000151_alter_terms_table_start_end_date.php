<?php

use Collejo\Foundation\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterTermsTableStartEndDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('terms', function (Blueprint $table) {
            $table->dateTime('start_date')->change();
            $table->dateTime('end_date')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*
         * Since mysql Doctrine\DBAL does not support timestamps
         * we can't reverse the migration
         */
    }
}
