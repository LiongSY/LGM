<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->string('customerID')->primary();
            $table->string('titles');
            $table->string('remarks');
            $table->foreignId('userID')->constrained('users', 'userID');
            $table->string('passportNo');
            $table->foreign('passportNo')->references('passportNo')->on('passports')->onDelete('cascade');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
