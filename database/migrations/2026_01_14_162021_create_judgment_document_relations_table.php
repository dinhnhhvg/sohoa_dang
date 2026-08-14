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
        Schema::create('judgment_document_relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('judgment_document_id')->constrained('judgment_documents')->cascadeOnDelete();
            $table->foreignId('document_relation_id')->constrained('judgment_documents')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('judgment_document_relations', function (Blueprint $table) {
            $table->dropForeign(['judgment_document_id']);
            $table->dropForeign(['document_relation_id']);
        });
        Schema::dropIfExists('judgment_document_relations');
    }
};
