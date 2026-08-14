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
        Schema::create('chapter_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chapter_id')->constrained('chapters')->cascadeOnDelete();
            $table->string('name', 255);
            $table->foreignId('type_id')->constrained('types')->cascadeOnDelete();
            $table->text('file_path')->nullable();
            $table->text('content')->nullable();
            $table->boolean('is_free')->default(0);
            $table->integer('order_number')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chapter_documents', function (Blueprint $table) {
            $table->dropForeign(['type_id']);
            $table->dropForeign(['chapter_id']);
        });
        Schema::dropIfExists('chapter_documents');
    }
};
