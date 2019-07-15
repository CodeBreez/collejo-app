<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeeGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_grades', function (Blueprint $table) {
            $table->string('id', 45)->primary();
            $table->string('name', 20);
            $table->string('code', 10)->nullable();
            $table->integer('priority')->default(0);
            $table->integer('max_sessions_per_day')->default(0);
            $table->integer('max_sessions_per_week')->default(0);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });

        Schema::table('employee_grades', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('employee_grades');
    }
}
