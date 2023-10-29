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
            $table->string('tourCode')->primary();
            $table->string('tourLanguages');
            $table->float('tourPrice');
            $table->string('tourStatus');
            $table->integer('noOfSeats');
            $table->string('packageID');
            $table->foreign('packageID')->references('packageID')->on('packages')->onDelete('cascade');
            $table->string('flightID');
            $table->foreign('flightID')->references('flightID')->on('flights')->onDelete('cascade');
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
