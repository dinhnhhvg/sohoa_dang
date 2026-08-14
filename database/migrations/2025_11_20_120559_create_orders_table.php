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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->foreignId('contact_id')->nullable()->constrained('contacts')->nullOnDelete();
            $table->foreignId('status_id')->constrained('statuses')->cascadeOnDelete();
            $table->text('note')->nullable();
            $table->text('content')->nullable();
            $table->foreignId('type_id')->constrained('types')->cascadeOnDelete();
            $table->integer('total_amount')->default(0);
            $table->integer('discount_amount')->default(0);
            $table->foreignId('coupon_id')->nullable()->constrained('coupons');
            $table->integer('coupon_amount')->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropForeign(['contact_id']);
            $table->dropForeign(['status_id']);
            $table->dropForeign(['type_id']);
        });
        Schema::dropIfExists('orders');
    }
};
