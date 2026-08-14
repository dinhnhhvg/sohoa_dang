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
        Schema::create('judgment_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('judgment_id')->constrained('judgments')->cascadeOnDelete();

            // Thong tin File
            $table->string('file_path', 510)->comment('file path');
            $table->string('renamed_file_path', 510)->comment('file path');
            $table->string('name', '255')->nullable()->comment('Tên');
            $table->text('description')->nullable()->comment('Mô tả');

            $table->foreignId('language_id')->nullable()->constrained('languages')->nullOnDelete();
            $table->foreignId('physical_condition_id')->nullable()->constrained('configs')->nullOnDelete();

            $table->integer('sheets_count')->nullable()->comment('Số tờ trong file');
            $table->integer('pages_count')->nullable()->comment('Số trang trong file');
            $table->bigInteger('file_size')->nullable()->comment('Số dung lượng');

            $table->foreignId('agency_id')->nullable()->constrained('agencies')->nullOnDelete()->comment('Tòa án ban hành');
            $table->foreignId('old_agency_id')->nullable()->constrained('old_agencies')->nullOnDelete()->comment('Tòa án ban hành');

            // Thông tin chi tiết văn bản
            $table->string('document_number')->nullable()->comment('Số của văn bản');
            $table->string('document_notation')->nullable()->comment('Ký hiệu của văn bản');
            $table->date('issue_date')->nullable()->comment('Ngày ký (Ngày, tháng, năm văn bản)');

            $table->foreignId('document_genre_id')->nullable()->constrained('configs')->nullOnDelete()->commen('Thể loại văn bản');

            $table->text('content_summary')->nullable()->comment('Trích yếu nội dung');
            $table->string('signer')->nullable()->comment('Người ký');

            $table->foreignId('confidentiality_level_id')->nullable()->constrained('configs')->nullOnDelete()->comment('Độ mật: Thường, Mật, Tối mật, Tuyệt mật');
            $table->foreignId('copy_type_id')->nullable()->constrained('configs')->nullOnDelete()->comment('Loại bản: Bản chính, Bản sao, Bản gốc, Bản thảo');

            $table->string('keywords')->nullable()->comment('Từ khóa');
            $table->string('topic')->nullable()->comment('Chuyên đề');
            $table->string('original_doc_location')->nullable()->comment('Địa chỉ tài liệu gốc');
            $table->string('data_entry_by')->nullable()->comment('Người nhập tin');
            $table->integer('doc_order_in_dossier')->nullable()->comment('Số thứ tự văn bản trong hồ sơ');
            $table->string('page_number')->nullable()->comment('Trang số');
            $table->string('info_code')->nullable()->comment('Ký hiệu thông tin');

            $table->foreignId('usage_mode_id')->nullable()->constrained('configs')->nullOnDelete()->commen('Chế độ sử dụng');

            $table->text('handwritten_notes')->nullable()->comment('Bút tích');

            $table->foreignId('document_type_id')->nullable()->constrained('configs')->nullOnDelete()->commen('Loại văn bản');

            $table->text('note')->nullable()->comment('Ghi chú');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('judgment_documents');
    }
};
