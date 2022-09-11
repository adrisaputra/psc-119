<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('handlings', function (Blueprint $table) {
            $table->increments('id',11);
            $table->foreignUuid('complaint_id')->references('id')->on("complaints");
            $table->text('diagnosis')->nullable();
            $table->text('handling')->nullable();
            $table->dateTime('response_time')->nullable();
            $table->dateTime('done_time')->nullable();
            $table->enum('status', ['accept','reject','done']);
            $table->foreignUuid('user_id')->references('id')->on("users");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('handlings');
    }
};
