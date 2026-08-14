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
        Schema::create('item_medias', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('item_type');
            $table->unsignedBigInteger('item_id');
            $table->string('type')->comment('image, video');
            $table->string('file_path')->nullable();
            $table->integer('order_number')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->index(['item_type', 'item_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_medias');
    }
};
