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
            $table->string('flightNumber')->primary();
            $table->date('departureDate');
            $table->date('returnDate');
            $table->string('sector');
            $table->string('airlines');
            $table->time('departureTime');
            $table->time('returnTime');
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
