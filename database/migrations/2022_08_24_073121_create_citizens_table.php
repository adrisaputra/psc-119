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
        Schema::create('citizens', function (Blueprint $table) {
            $table->increments('id',11);
            $table->string('name',100)->nullable();
            $table->string('phone_number',50)->nullable();
            $table->string('address',50)->nullable();
            $table->string('nik',16)->nullable();
            
            $table->unsignedInteger('village_id');
            $table->foreign("village_id")->references('id')->on("villages");

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
        Schema::dropIfExists('citizens');
    }
};
