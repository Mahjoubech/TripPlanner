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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
         TRIP-2-create-base-de-données-and-Models
            $table->string('password');
            $table->enum('type', ['client', 'organizer', 'admin']);
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();
            $table->text('bio')->nullable();
            $table->string('status')->default('active');
            $table->string('identification_document')->nullable();
            $table->string('CNE')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
           main
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
