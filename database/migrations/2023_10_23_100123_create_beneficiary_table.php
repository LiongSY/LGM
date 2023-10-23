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
        Schema::create('beneficiary', function (Blueprint $table) {
            $table->String('benID')->primary();
            $table->string('benTitle');
            $table->string('benName');
            $table->string('benIC');
            $table->string('benRelationship');
            $table->string('benContact');
            $table->string('benAddress');
            
            // Optional foreign key relationship with Customers table
            $table->String('customerID')->nullable();
            $table->foreign('customerID')->references('customerID')->on('customers')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beneficiary');
    }
};
