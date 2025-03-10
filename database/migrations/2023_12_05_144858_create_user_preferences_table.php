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
         Schema::create('user_preferences', function (Blueprint $table) {
             $table->id();
             $table->unsignedInteger('userID');
             $table->string('season', 50);
             $table->string('activity', 50);
             $table->string('accomodation', 50);
             $table->string('destination', 50);
             $table->string('travelGroup', 50);
             $table->timestamps();
 
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_preferences');
    }
};
