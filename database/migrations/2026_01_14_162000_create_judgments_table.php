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
        Schema::create('judgments', function (Blueprint $table) {
            $table->id();
            $table->string('folder_path', 510)->comment('folder path');

            $table->foreignId('batch_id')->constrained('batches')->cascadeOnDelete();

            $table->boolean('is_after_merge')->default(false)->comment('0: trước sát nhập, 1: sau sát nhập');

            $table->foreignId('font_id')->nullable()->constrained('configs')->nullOnDelete()->comment('Phông');

            $table->foreignId('tenure_period_id')->nullable()->constrained('configs')->nullOnDelete()->comment('Nhiệm kỳ');

            $table->string('table_of_contents_number')->nullable()->comment('Mục lục số');
            $table->string('box_number')->nullable()->comment('Hộp số');
            $table->string('dossier_number')->nullable()->comment('Hồ sơ số');

            $table->foreignId('retention_period_id')->nullable()->constrained('configs')->nullOnDelete()->comment('Thời hạn bảo quản');

            $table->text('dossier_title')->nullable()->comment('Tiêu đề hồ sơ');

            // Thời gian & Số lượng hồ sơ
            $table->date('start_date')->nullable()->comment('Thời gian bắt đầu');
            $table->date('end_date')->nullable()->comment('Thời gian kết thúc');

            $table->text('description')->nullable()->comment('Mô tả');

            $table->foreignId('status_id')->constrained('statuses')->cascadeOnDelete();

            $table->foreignId('language_id')->nullable()->constrained('languages')->nullOnDelete();
            $table->foreignId('physical_condition_id')->nullable()->constrained('configs')->nullOnDelete();

            $table->foreignId('entry_id')->nullable()->constrained('users')->nullOnDelete()->comment('NV nhập liệu');
            $table->foreignId('checker_id')->nullable()->constrained('users')->nullOnDelete()->comment('NV kiểm duyệt');

            $table->timestamp('entried_at')->nullable()->comment('Ngày nhập liệu');
            $table->timestamp('checked_at')->nullable()->comment('Ngày kiểm duyệt');

            $table->longText('entry_json')->nullable()->comment('Data nhập liệu');
            $table->integer('entry_number')->default(0)->comment('Số trường nhập liệu');
            $table->integer('check_number')->default(0)->comment('Số trưởng chỉnh sửa');
            $table->integer('check_number_rate')->default(0)->comment('Tỉ lệ nhập sai');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('judgments', function (Blueprint $table) {
            $table->dropForeign(['batch_id']);
            $table->dropForeign(['type_id']);
            $table->dropForeign(['status_id']);
            $table->dropForeign(['language_id']);
            $table->dropForeign(['physical_condition_id']);
            $table->dropForeign(['entry_id']);
            $table->dropForeign(['checker_id']);
        });
        Schema::dropIfExists('judgments');
    }
};
