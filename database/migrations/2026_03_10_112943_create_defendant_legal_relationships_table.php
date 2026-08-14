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
        Schema::create('defendant_legal_relationships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('defendant_id')->constrained('defendants')->cascadeOnDelete();
            $table->foreignId('legal_relationship_id')->constrained('configs')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('defendant_judicial_measure_names', function (Blueprint $table) {
            $table->dropForeign('def_jud_meas_def_id_foreign');
            $table->dropForeign('def_jud_meas_config_id_foreign');
        });
        Schema::dropIfExists('defendant_judicial_measure_names');
    }
};
