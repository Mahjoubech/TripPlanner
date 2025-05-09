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
        Schema::create('trip_transports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')->constrained('trips')->onDelete('cascade');
            $table->foreignId('transport_id')->constrained('transports')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        
        Schema::table('trip_transports', function (Blueprint $table) {
            $table->dropForeign(['transport_id']);
        });
        Schema::dropIfExists('trip_transports');
    }
};
