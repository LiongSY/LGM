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
            $table->String('packageID')->primary();
            $table->string('packageName');
            $table->string('packageImage');
            $table->longText('highlight');
            $table->string('itineraryPdf');
            $table->longText('remarks');
            $table->string('destination');
            $table->float('singleRoom');
            $table->float('doubleRoom');
            $table->float('tripleRoom');
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
