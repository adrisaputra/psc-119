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
        Schema::create('officers', function (Blueprint $table) {
            $table->increments('id',11);
            $table->string('name',100)->nullable();
            $table->string('phone_number',50)->nullable();
            $table->string('address',50)->nullable();
            $table->enum('status', ['available', 'noavailable']);
            
            $table->unsignedInteger('unit_id');
            $table->foreign("unit_id")->references('id')->on("units");

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
        Schema::dropIfExists('officers');
    }
};
