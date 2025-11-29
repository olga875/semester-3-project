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
        Schema::create('interval_program', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_standing');
<<<<<<< HEAD
            $table->int('time_amount');
=======
            $table->integer('time_amount');
>>>>>>> 3718dc5504ad4c6853f95a254b951b2fd1a7921f
            $table->foreignId('interval_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interval_program');
    }
};
