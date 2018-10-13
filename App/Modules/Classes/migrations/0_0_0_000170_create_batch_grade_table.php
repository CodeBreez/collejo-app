<?php

use Collejo\Foundation\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->string('batch_id', 45)->nullable();
            $table->string('grade_id', 45)->nullable();
            $table->string('created_by')->nullable();
            $table->timestamp('created_at');
        });

        Schema::table('batch_grade', function (Blueprint $table) {
            $table->foreign('batch_id')->references('id')->on('batches')->onDelete('cascade');
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users');
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
