<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->unsignedBigInteger('tourCode')->primary();
            $table->date('departureDate');
            $table->string('tourLanguages');
            $table->float('tourPrice');
            $table->string('tourStatus');
            $table->integer('noOfSeats');

            $table->unsignedBigInteger('flightNumber');
            $table->foreign('flightNumber')->references('flightNumber')->on('flights')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
