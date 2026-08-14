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
        Schema::create('defendant_penalties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('defendant_id')->constrained('defendants')->cascadeOnDelete();
            $table->foreignId('penalty_id')->constrained('configs')->cascadeOnDelete();
            $table->boolean('is_main')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('defendant_penalties', function (Blueprint $table) {
            $table->dropForeign(['defendant_id']);
            $table->dropForeign(['penalty_id']);
        });
        Schema::dropIfExists('defendant_penalties');
    }
};
