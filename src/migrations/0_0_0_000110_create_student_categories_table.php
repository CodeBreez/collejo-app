<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_categories', function (Blueprint $table) {
            $table->string('id', 45)->primary();
            $table->string('name', 20)->unique();
            $table->string('code', 10)->nullable();
            $table->string('created_by')->nullable();
            $table->timestamp('created_at');
            $table->softDeletes();
        });

        Schema::table('student_categories', function (Blueprint $table) {
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
        Schema::drop('student_categories');
    }
}
