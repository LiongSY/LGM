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
        Schema::create('beneficiary', function (Blueprint $table) {
            $table->string('benID')->primary();
            $table->string('benTitle');
            $table->string('benName');
            $table->string('benIC');
            $table->string('benRelationship');
            $table->string('benContact');
            $table->string('benAddress');
            
            // Optional foreign key relationship with Customers table
            $table->unsignedBigInteger('customerID')->nullable();
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
