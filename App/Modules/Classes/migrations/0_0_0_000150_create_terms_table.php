<?php

use Collejo\Foundation\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->string('id', 45)->primary();
            $table->string('batch_id', 45)->nullable();
            $table->string('name', 45);
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('terms', function (Blueprint $table) {
            $table->foreign('batch_id')->references('id')->on('batches')->onDelete('cascade');
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
        Schema::drop('terms');
    }
}
