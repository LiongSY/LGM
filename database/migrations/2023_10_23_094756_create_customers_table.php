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
        Schema::create('customers', function (Blueprint $table) {
            $table->string('customerID')->primary();
            $table->string('titles');
            $table->mediumText('remarks');
            $table->unsignedInteger('userID');
            $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');
            $table->string('passportNo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
