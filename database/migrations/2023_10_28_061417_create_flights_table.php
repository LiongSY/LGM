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
        Schema::create('flights', function (Blueprint $table) {
            $table->String('flightID')->primary();
            $table->date('departureDate');
            $table->date('arrivalDate');
            $table->date('returnDepartureDate');
            $table->date('returnArrivalDate');
            $table->string('sector');
            $table->string('airlines');
            $table->string('flightNumber');
            $table->string('returnSector');
            $table->string('returnAirlines');
            $table->string('returnFlightNumber');
            $table->time('departureTime');
            $table->time('arrivalTime');
            $table->time('returnDepartureTime');
            $table->time('returnArrivalTime');
            // Foreign key to associate flights with tours
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
