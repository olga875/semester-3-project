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
        Schema::create('interval', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->int('sitting_time');    // in minutes
            $table->int('standing_time');   // in minutes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interval');
    }
};
