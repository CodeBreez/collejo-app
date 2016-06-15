<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->string('id', 45)->primary();
            $table->string('parent_id', 45)->nullable()->default(null);
            $table->string('permission');
            $table->string('description');
            $table->timestamps();
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('permissions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('permissions');
    }
}
