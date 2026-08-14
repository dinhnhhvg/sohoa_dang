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
        Schema::create('judgment_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('judgment_id')->constrained('judgments')->cascadeOnDelete();
            $table->foreignId('language_id')->constrained('languages')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('judgment_languages', function (Blueprint $table) {
            $table->dropForeign(['judgment_id']);
            $table->dropForeign(['language_id']);
        });
        Schema::dropIfExists('judgment_languages');
    }
};
