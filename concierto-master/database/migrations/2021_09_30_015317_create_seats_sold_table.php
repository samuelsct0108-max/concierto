<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeatsSoldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seat_sold', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seat_number');
            $table->unsignedBigInteger('id_seller')->nullable();
            $table->string('payment_method')->nullable();
            $table->timestamps();

            // Definición de la llave foránea
            $table->foreign('seat_number')->references('id')->on('seats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seat_sold');
    }
}
