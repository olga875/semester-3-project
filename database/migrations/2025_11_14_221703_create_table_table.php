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
        // still needs the data given by the API added
<<<<<<< HEAD
        Schema::create('table', function (Blueprint $table) {
            $table->id();
            $table->int('current_height');      // in mm
            $table->string('location_building');
            $table->string('location_room');
            $table->string('name');
        });
=======
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->integer('current_height');      // in mm
            $table->string('name');
        });
        
>>>>>>> 3718dc5504ad4c6853f95a254b951b2fd1a7921f
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table');
    }
};
