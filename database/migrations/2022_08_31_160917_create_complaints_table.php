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
        Schema::create('complaints', function (Blueprint $table) {
            $table->uuid('id', 36)->primary();
            $table->string('ticket_number',100)->nullable();
            $table->string('phone_number',50)->nullable();
            $table->string('name',100)->nullable();
            $table->text('incident_area')->nullable();
            $table->text('summary')->nullable();

            $table->unsignedInteger('category_id');
            $table->foreign("category_id")->references('id')->on("categories");

            $table->string('psc',50)->nullable();
            $table->enum('status', ['request', 'process','dispatch','accept','reject','done']);

            $table->unsignedInteger('unit_id');
            $table->foreign("unit_id")->references('id')->on("units");

            $table->string('coordinate',255)->nullable();
            $table->string('image',50)->nullable();
            $table->enum('report_type', ['emergency', 'phone','complaint']);
            $table->enum('handling_status', ['home', 'refer']);
            $table->string('reference_place',255)->nullable();

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
        Schema::dropIfExists('complaints');
    }
};
