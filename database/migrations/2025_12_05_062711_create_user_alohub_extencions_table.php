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
        Schema::create('user_alohub_extensions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('alohub_extension_id')->constrained('alohub_extensions')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_alohub_extensions', function (Blueprint $table) {
            $table->id();
            $table->dropForeign(['user_id']);
            $table->dropForeign(['alohub_extension_id']);
        });
        Schema::dropIfExists('user_alohub_extensions');
    }
};
