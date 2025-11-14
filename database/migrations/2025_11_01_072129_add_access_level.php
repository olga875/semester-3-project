<?php

use App\Enums\AccessLevels;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// was added to create_user_tables

/*
 return new class extends Migration
{
    /**
     * Run the migrations.
     /
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('access_level')->default(AccessLevels::NONE);
        });
    }

    /**
     * Reverse the migrations.
     /
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('access_level');
        });
    }
};
*/ 
