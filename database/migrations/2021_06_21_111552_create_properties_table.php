<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owners_id');
            $table->unsignedBigInteger('areas_id');
            $table->unsignedBigInteger('property_types_id');
            $table->integer('price');
            $table->integer('size');
            $table->integer('floor')->default(0);
            $table->integer('room_number')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->text('address');
            $table->mediumText('description');
            $table->longText('image');
            $table->integer('famous')->default(0);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('owners_id')->references('id')->on('owners')->onDelete('cascade');
            $table->foreign('areas_id')->references('id')->on('areas')->onDelete('cascade');
            $table->foreign('property_types_id')->references('id')->on('property_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
