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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organizer_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->string('location');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('duration');
            $table->decimal('price', 10, 2);
            $table->integer('max_participants');
            $table->string('image')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->string('status')->default('pending'); // Default status is now 'pending'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Drop the trips table
        Schema::dropIfExists('trips');
    }
};