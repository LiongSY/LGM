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
        Schema::create('bookings', function (Blueprint $table) {
            $table->String('bookingID')->primary();
            $table->date('bookingDate');
            $table->integer('noOfAdult');
            $table->integer('noOfChild');
            $table->integer('noOfInfant');
            $table->longText('noOfRoom');
            $table->longText('typesOfRoom');
            $table->float('bookingAmount');
            $table->float('bookingDeposit');
            $table->string('bookingStatus');
            $table->longText('bookingRemarks');
            $table->string('tourCode');
            $table->string('customerID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
