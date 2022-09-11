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
        Schema::create('switch_officers', function (Blueprint $table) {
            $table->increments('id',11);
            $table->foreignUuid('complaint_id')->references('id')->on("complaints");
            $table->text('description')->nullable();
            
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
        Schema::dropIfExists('switch_officers');
    }
};
