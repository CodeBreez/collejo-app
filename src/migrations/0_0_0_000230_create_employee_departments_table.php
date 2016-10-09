<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_departments', function (Blueprint $table) {
            $table->string('id', 45)->primary();
            $table->string('name', 20);
            $table->string('code', 10)->nullable();
            $table->string('created_by')->nullable();
            $table->timestamp('created_at');
            $table->softDeletes();
        });

        Schema::table('employee_departments', function (Blueprint $table) {
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
        Schema::drop('employee_departments');
    }
}
