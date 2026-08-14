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
        Schema::create('lesson_customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_customer_id')->constrained('class_customers')->cascadeOnDelete();
            $table->foreignId('lesson_id')->constrained('lessons')->cascadeOnDelete();
            $table->foreignId('status_id')->nullable()->constrained('statuses')->cascadeOnDelete();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lesson_customers', function (Blueprint $table) {
            $table->dropForeign(['class_customer_id']);
            $table->dropForeign(['lesson_id']);
            $table->dropForeign(['status_id']);
        });
        Schema::dropIfExists('lesson_customers');
    }
};
