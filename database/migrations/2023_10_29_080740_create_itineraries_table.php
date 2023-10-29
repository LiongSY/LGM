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
        Schema::create('itineraries', function (Blueprint $table) {
            $table->string('packageID');
            $table->integer('noOfDays');
            $table->string('hotelName');
            $table->string('meals');
            $table->longText('remarks');
            $table->longText('information');
            $table->foreign('packageID')->references('packageID')->on('packages')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itineraries');
    }
};
