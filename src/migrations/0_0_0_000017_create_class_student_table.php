<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_student', function (Blueprint $table) {
            $table->string('id', 45)->primary();
            $table->string('class_id', 45);
            $table->string('student_id', 45);
            $table->string('batch_id', 45);
        });

        Schema::table('class_student', function (Blueprint $table) {
            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('batch_id')->references('id')->on('batches');
            $table->foreign('student_id')->references('id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('class_student');
    }
}
