<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owners_id');
            $table->unsignedBigInteger('customers_id');
            $table->unsignedBigInteger('properties_id');
            $table->mediumText('description');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('owners_id')->references('id')->on('owners')->onDelete('cascade');
            $table->foreign('customers_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('properties_id')->references('id')->on('properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
