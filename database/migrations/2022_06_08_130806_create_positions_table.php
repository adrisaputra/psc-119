<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->bigIncrements('id')->nullable();
            $table->string('position_name')->nullable();
            $table->integer('position_leader')->nullable();
            
            $table->unsignedBigInteger('position_class_id');
            $table->foreign("position_class_id")->references('id')->on("position_classes");

            $table->unsignedBigInteger('office_id');
            $table->foreign("office_id")->references('id')->on("offices");

            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('positions');
    }
}
