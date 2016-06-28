<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatchGradeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_grade', function (Blueprint $table) {
            $table->string('id', 45)->primary();
            $table->string('batch_id', 45);
            $table->string('grade_id', 45);
        });

        Schema::table('batch_grade', function (Blueprint $table) {
            $table->foreign('batch_id')->references('id')->on('batches');
            $table->foreign('grade_id')->references('id')->on('grades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('batch_grade');
    }
}
