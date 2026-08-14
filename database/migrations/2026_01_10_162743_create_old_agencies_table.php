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
        Schema::create('old_agencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('old_agency_id')->nullable()->constrained('old_agencies')->nullOnDelete();
            $table->string('code', 255);
            $table->string('name', 255);
            $table->string('email')->nullable();
            $table->string('phone', 15)->nullable();
            $table->text('description')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('old_agencies');
    }
};
