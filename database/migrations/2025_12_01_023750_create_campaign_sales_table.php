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
        Schema::create('campaign_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained('campaigns')->cascadeOnDelete();
            $table->foreignId('sale_id')->constrained('users')->cascadeOnDelete();
        });
    }

     /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('campaign_sales', function (Blueprint $table) {
            $table->dropForeign(['campaign_id']);
            $table->dropForeign(['sale_id']);
        });
        Schema::dropIfExists('campaign_sales');
    }
};
