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
        Schema::create('table', function (Blueprint $table) {
            $table->id();
            $table->int('current_height');      // in mm
            $table->string('location_building');
            $table->string('location_room');
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table');
    }
};
