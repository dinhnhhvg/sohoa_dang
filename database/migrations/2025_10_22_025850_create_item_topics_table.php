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
        Schema::create('item_topics', function (Blueprint $table) {
            $table->string('item_type');
            $table->unsignedBigInteger('item_id');
            $table->foreignId('topic_id')->constrained('topics')->cascadeOnDelete();

            $table->index(['item_id', 'item_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('item_topics', function (Blueprint $table) {
            $table->dropForeign(['topic_id']);
        });
        Schema::dropIfExists('item_topics');
    }
};
