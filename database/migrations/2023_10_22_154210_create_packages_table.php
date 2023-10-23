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
        Schema::create('packages', function (Blueprint $table) {
            $table->string('packageID')->primary();
            $table->string('highlight');
            $table->string('itineraryPdf');
            $table->string('remarks');
            $table->string('destination');
            $table->float('costing');
            $table->string('itineraryID');
            $table->foreign('itineraryID')->references('itineraryID')->on('itineraries')->onDelete('cascade');
            $table->string('tourCode');
            $table->foreign('tourCode')->references('tourCode')->on('tours')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
