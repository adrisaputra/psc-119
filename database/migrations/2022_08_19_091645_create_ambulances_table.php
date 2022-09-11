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
        Schema::create('ambulances', function (Blueprint $table) {
            $table->increments('id',11);
            $table->string('name',100)->nullable();

            $table->unsignedInteger('officer_id');
            $table->foreign("officer_id")->references('id')->on("officers");

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
        Schema::dropIfExists('ambulances');
    }
};
