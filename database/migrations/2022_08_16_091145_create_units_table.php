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
        Schema::create('units', function (Blueprint $table) {
            $table->increments('id',11);
            $table->string('name',100)->nullable();
            $table->string('address',50)->nullable();
            $table->string('coordinate',255)->nullable();
            
            $table->unsignedInteger('subdistrict_id');
            $table->foreign("subdistrict_id")->references('id')->on("subdistricts");

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
        Schema::dropIfExists('units');
    }
};
