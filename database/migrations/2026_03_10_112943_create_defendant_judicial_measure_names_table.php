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
        Schema::create('defendant_judicial_measure_names', function (Blueprint $table) {
            $table->id();
            $table->foreignId('defendant_id')->constrained('defendants', indexName: 'def_jud_meas_def_id_foreign')->cascadeOnDelete();

            $table->foreignId('judicial_measure_name_id')->constrained('configs', indexName: 'def_jud_meas_config_id_foreign')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('defendant_judicial_measure_names', function (Blueprint $table) {
            $table->dropForeign(['defendant_id']);
            $table->dropForeign(['judicial_measure_name_id']);
        });
        Schema::dropIfExists('defendant_judicial_measure_names');
    }
};
