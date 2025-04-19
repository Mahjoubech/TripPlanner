<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            $table->enum('type', ['client', 'organizer', 'admin']);

            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();
            $table->text('bio')->nullable();

            // For organizers
            $table->string('CIN')->nullable();
            $table->string('document_number')->nullable();
            $table->string('identification_document')->nullable();
            $table->boolean('is_document_verified')->default(false);
            $table->enum('approval_status', ['pending', 'approved', 'rejected'])->default('pending')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('status')->default('active');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        

        // Drop the users table
        Schema::dropIfExists('users');
    }
};