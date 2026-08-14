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
        Schema::create('defendant_nationalities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('defendant_id')->constrained('defendants')->cascadeOnDelete();
            $table->foreignId('nationality_id')->constrained('nationalities')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('defendant_nationalities', function (Blueprint $table) {
            $table->dropForeign(['defendant_id']);
            $table->dropForeign(['nationality_id']);
        });
        Schema::dropIfExists('defendant_nationalities');
    }
};
