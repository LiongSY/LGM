<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('users', function (Blueprint $table) {
        $table->increments('userID');
        $table->string('name');
        $table->string('email')->unique();
        $table->string('phoneNo');
        $table->string('password');
        $table->string('gender')->nullable;
        $table->string('nationality')->nullable;
        $table->string('identityNo')->nullable;
        $table->string('address')->nullable;
        $table->string('role');
        $table->rememberToken();
        $table->timestamp('email_verified_at')->nullable();
        $table->timestamps();
    });
}
  
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
