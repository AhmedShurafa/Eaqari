<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owners_id');
            $table->unsignedBigInteger('properties_id');
            $table->unsignedBigInteger('customers_id');
            $table->unsignedBigInteger('transaction_types_id');
            $table->string('details',255);
            $table->timestamps();
            $table->timestamp('deleted_id')->nullable();

            $table->foreign('owners_id')->references('id')
                ->on('owners')->onDelete('cascade');

            $table->foreign('properties_id')->references('id')
                ->on('properties')->onDelete('cascade');

            $table->foreign('customers_id')->references('id')
                ->on('customers')->onDelete('cascade');

            $table->foreign('transaction_types_id')->references('id')
                ->on('transaction_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
