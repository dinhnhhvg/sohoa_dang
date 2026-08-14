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
        Schema::create('lesson_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('classes')->cascadeOnDelete();
            $table->foreignId('type_id')->constrained('types')->cascadeOnDelete();
            $table->string('name', 255);
            $table->tinyInteger('day_of_week');
            $table->text('content')->nullable();
            $table->text('value')->nullable()->comment('JSON DATA from meeting,zoom,...');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('duration')->comment('minute')->nullable();
            $table->foreignId('center_id')->nullable()->constrained('centers')->nullOnDelete();
            $table->foreignId('classroom_id')->nullable()->constrained('classrooms')->nullOnDelete();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lesson_schedules', function (Blueprint $table) {
            $table->dropForeign(['class_id']);
            $table->dropForeign(['type_id']);
            $table->dropForeign(['center_id']);
            $table->dropForeign(['classroom_id']);
        });
        Schema::dropIfExists('lesson_schedules');
    }
};
