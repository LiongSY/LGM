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
        Schema::create('package_room', function (Blueprint $table) {
            $table->string('packageID')->primary();
            $table->string('roomID')->primary();
            $table->foreign('packageID')->references('packageID')->on('packages')->onDelete('cascade');
            $table->foreign('roomID')->references('roomID')->on('rooms')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_room');
    }
};
