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
        Schema::create('old_districts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('old_province_id')->constrained('old_provinces')->cascadeOnDelete();
            $table->string('code', 255);
            $table->string('code_name', 255);
            $table->string('prefix', 255)->nullable();
            $table->string('name', 255);
            $table->string('full_name', 255);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('old_districts', function (Blueprint $table) {
            $table->dropForeign(['old_province_id']);
        });
        Schema::dropIfExists('old_districts');
    }
};
