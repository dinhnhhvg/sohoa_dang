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
        Schema::create('chapter_videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chapter_id')->constrained('chapters')->cascadeOnDelete();
            $table->string('name', 255);
            $table->foreignId('type_id')->constrained('types')->cascadeOnDelete();
            $table->text('src')->nullable();
            $table->foreignId('video_id')->nullable()->constrained('videos')->nullOnDelete();
            $table->text('content')->nullable();
            $table->integer('duration')->default(60);
            $table->integer('max_view')->nullable();
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
        Schema::table('chapter_videos', function (Blueprint $table) {
            $table->dropForeign(['type_id']);
            $table->dropForeign(['chapter_id']);
            $table->dropForeign(['video_id']);
        });
        Schema::dropIfExists('chapter_videos');
    }
};
