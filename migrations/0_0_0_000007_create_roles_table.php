<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->string('id', 45)->primary();
            $table->string('parent_id', 45)->nullable()->default(null);
            $table->string('role')->unique();
            $table->string('description');
            $table->timestamps();
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('roles');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('roles');
    }
}
