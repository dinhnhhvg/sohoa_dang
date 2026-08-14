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
        Schema::table('users', function (Blueprint $table) {
            $table->after('id', function (Blueprint $table) {
                $table->foreignId('role_id')->nullable()->constrained('roles')->nullOnDelete();
                $table->foreignId('center_id')->nullable()->constrained('centers')->nullOnDelete();
                $table->foreignId('province_id')->nullable()->constrained('provinces')->nullOnDelete();
                $table->foreignId('ward_id')->nullable()->constrained('wards')->nullOnDelete();
                $table->text('note_value')->nullable();
                $table->text('care_value')->nullable();
                $table->text('address')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['center_id']);
            $table->dropForeign(['province_id']);
            $table->dropForeign(['ward_id']);

            $table->dropColumn(['role_id', 'center_id', 'province_id', 'ward_id', 'note_value', 'care_value', 'address']);
        });
    }
};
