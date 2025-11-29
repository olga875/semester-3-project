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
        Schema::create("buildings", function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string("name");
            $table->string("company");
            $table->string("address");
            $table->integer("floor_num");
            $table->timestamps();
        });

        Schema::create("floors", function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('company');
            $table->integer('room_num');
            $table->foreignUuid('building_id')->constrained('buildings')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('rooms', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('company');
            $table->integer('table_num');
            $table->foreignUuid('floor_id')->constrained('floors')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::table('tables', function (Blueprint $table) {
            $table->string('company_name');
            $table->foreignUuid("room_id")->constrained("rooms")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buildings');
        Schema::dropIfExists('floors');
        Schema::dropIfExists('rooms');
        Schema::table('table', function (Blueprint $table) {
        $table->dropForeign(['room_id']);
        $table->dropColumn(['room_id', 'company_name']);
    });
    }
};
