<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("owner_id");
            $table->enum("type", ['0', '1','2'])->default(0);
            $table->integer("price");
            $table->integer("size");
            $table->integer("room_number")->nullable();
            $table->integer("bathrooms")->nullable();
            $table->text("address");
            $table->mediumText("description");
            $table->longText("images");
            $table->enum("garage", ['0', '1'])->default(0);/* off */
            $table->enum("furniture", ['0', '1'])->default(0);/* off */

            $table->enum("rating", ['0', '1','2','3','4','5'])->default(0);/* off */
            $table->enum("status", ['0', '1'])->default(0);/* on */
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments');
    }
}
