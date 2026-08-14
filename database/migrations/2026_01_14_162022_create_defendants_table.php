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
        Schema::create('defendants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('judgment_id')->constrained('judgments')->cascadeOnDelete();
            $table->foreignId('judgment_document_id')->nullable()->constrained('judgment_documents')->nullOnDelete();

            $table->text('content_summary')->nullable()->comment('Trích yếu nội dung Bản án/Quyết định');
            $table->boolean('has_appeal')->default(0)->comment('Có kháng cáo hay không');
            $table->foreignId('marital_status_id')->nullable()->constrained('configs')->nullOnDelete()->commit('Trạng thái về tình trạng hôn nhân');

            $table->string('full_name')->nullable()->comment('Họ và tên');
            $table->string('alias_name')->nullable()->comment('Tên gọi khác');

            $table->foreignId('identity_document_id')->nullable()->constrained('configs')->nullOnDelete()->commit('Loại giấy tờ');
            $table->string('identity_number')->nullable()->comment('Số giấy tờ');
            $table->date('identity_created_date')->nullable()->comment('Ngày cấp');
            $table->string('identity_expiry_date')->nullable()->comment('Ngày hết hạn');

            $table->enum('gender', ['male', 'female'])->nullable()->comment('Giới tính');
            $table->date('birth_date')->nullable()->comment('Ngày tháng năm sinh');

            $table->foreignId('nationality_id')->nullable()->constrained('nationalities')->nullOnDelete()->commit('Quốc tịch');
            $table->foreignId('ethnicity_id')->nullable()->constrained('ethnicities')->nullOnDelete()->commit('Dân tộc');
            $table->foreignId('religion_id')->nullable()->constrained('religions')->nullOnDelete()->commit('Tôn giáo');

            $table->foreignId('permanent_province_id')->nullable()->constrained('provinces')->nullOnDelete()->comment('Nơi thường trú - Tỉnh/TP');
            $table->foreignId('permanent_ward_id')->nullable()->constrained('wards')->nullOnDelete()->comment('Nơi thường trú - Phường/Xã');
            $table->foreignId('permanent_old_province_id')->nullable()->constrained('old_provinces')->nullOnDelete()->comment('Nơi thường trú - Tỉnh/TP TSN');
            $table->foreignId('permanent_old_district_id')->nullable()->constrained('old_districts')->nullOnDelete()->comment('Nơi thường trú - Quận/huyện TSN');
            $table->foreignId('permanent_old_ward_id')->nullable()->constrained('old_wards')->nullOnDelete()->comment('Nơi thường trú - Phường/Xã TSN');
            $table->string('permanent_address')->nullable()->comment('Nơi thường trú - Địa chỉ chi tiết');

            $table->foreignId('hometown_province_id')->nullable()->constrained('provinces')->nullOnDelete()->comment('Quê quán - Tỉnh/TP');
            $table->foreignId('hometown_ward_id')->nullable()->constrained('wards')->nullOnDelete()->comment('Quê quán - Phường/Xã');
            $table->foreignId('hometown_old_province_id')->nullable()->constrained('old_provinces')->nullOnDelete()->comment('Quê quán - Tỉnh/TP TSN');
            $table->foreignId('hometown_old_district_id')->nullable()->constrained('old_districts')->nullOnDelete()->comment('Quê quán - Quận/huyện TSN');
            $table->foreignId('hometown_old_ward_id')->nullable()->constrained('old_wards')->nullOnDelete()->comment('Quê quán - Phường/Xã TSN');
            $table->string('hometown_address')->nullable()->comment('Quê quán - Địa chỉ');

            // Số giấy tờ người nước ngoài dùng nhập cảnh VN
            $table->foreignId('foreign_identity_document_id')->nullable()->constrained('configs')->nullOnDelete()->commit('Loại giấy tờ người nước ngoài');
            $table->string('foreign_identity_number')->nullable()->comment('Số giấy tờ người nước ngoài');

            $table->string('father_name')->nullable()->comment('Họ tên cha');
            $table->string('mother_name')->nullable()->comment('Họ tên mẹ');
            $table->string('spouse_name')->nullable()->comment('Họ tên vợ/chồng');

            // Thông tin của cơ quan, tổ chức
            $table->enum('organization_type', ['Cơ quan', 'Tổ chức'])->nullable()->comment('Loại cơ quan/tổ chức');
            $table->string('organization_name')->nullable()->comment('Tên cơ quan, tổ chức');
            $table->string('organization_tax_code')->nullable()->comment('Mã số thuế');
            $table->string('organization_business_registration_code')->nullable()->comment('Số đăng ký kinh doanh');

            $table->foreignId('organization_province_id')->nullable()->constrained('provinces')->nullOnDelete()->comment('cơ quan, tổ chức - Tỉnh/TP');
            $table->foreignId('organization_ward_id')->nullable()->constrained('wards')->nullOnDelete()->comment('cơ quan, tổ chức - Phường/Xã');
            $table->foreignId('organization_old_province_id')->nullable()->constrained('old_provinces')->nullOnDelete()->comment('cơ quan, tổ chức - Tỉnh/TP TSN');
            $table->foreignId('organization_old_district_id')->nullable()->constrained('old_districts')->nullOnDelete()->comment('cơ quan, tổ chức - Quận huyện TSN');
            $table->foreignId('organization_old_ward_id')->nullable()->constrained('old_wards')->nullOnDelete()->comment('cơ quan, tổ chức - Phường/Xã TSN');
            $table->string('organization_address')->nullable()->comment('cơ quan, tổ chức - Địa chỉ');

            // Thông tin tội danh và hình phạt
            $table->string('crime_name')->nullable()->comment('Tội danh');
            $table->text('legal_basis')->nullable()->comment('Điều, Khoản, Luật được áp dụng');

            // main_penalty: Hinh phat chinh o bang phu
            $table->text('main_penalty_value')->nullable()->comment('Thời hạn/giá trị hình phạt chính');

            $table->enum('suspended_sentence', ['Không', 'Có'])->nullable()->comment('Hưởng án treo');
            $table->bigInteger('first_instance_court_fee')->nullable()->comment('Án phí phúc thẩm');
            $table->bigInteger('appellate_court_fee')->nullable()->comment('Án phí sơ thẩm');
            $table->bigInteger('civil_court_fee')->nullable()->comment('Án phí dân sự');
            $table->bigInteger('total_court_fee')->nullable()->comment('Án phí tổng');
            $table->enum('court_fee_status', ['Không', 'Có'])->nullable()->comment('Miễn án phí');

            // additional_penalty: Hinh phat chinh o bang phu
            $table->string('additional_penalty_value')->nullable()->comment('Thời hạn/giá trị hình phạt bổ sung');

            // Cấm đản nhiệm chức vụ
            $table->string('prohibited_position')->nullable()->comment('Chức vụ cấm đảm nhiệm');
            $table->string('prohibition_duration')->nullable()->comment('Thời hạn cấm');
            $table->date('prohibition_start_date')->nullable()->comment('Thời gian bắt đầu cấm');

            // Biện pháp tư pháp
            $table->foreignId('judicial_measure_name_id')->nullable()->constrained('configs')->nullOnDelete()->commit('Tên biện pháp');
            $table->foreignId('judicial_measure_issuer_id')->nullable()->constrained('configs')->cascadeOnDelete()->commit('Đơn vị ra quyết định');
            $table->date('judicial_measure_start_date')->nullable()->comment('Ngày bắt đầu hiệu lực');
            $table->date('judicial_measure_end_date')->nullable()->comment('Ngày hết hạn hiệu lực');

            // Nghĩa vụ dân sự - Án tích
            $table->text('civil_obligation')->nullable()->comment('Nghĩa vụ dân sự');
            $table->enum('criminal_record_status', ['Không có án tích', 'Có án tích'])->nullable()->comment('Thông tin về tình trạng án tích');
            $table->text('criminal_record_description')->nullable()->comment('Mô tả án tích');

            // Ban an hon nhan
            $table->foreignId('legal_relationship_id')->nullable()->constrained('configs')->nullOnDelete()->commit('Quan hệ tố tụng');
            $table->foreignId('litigation_status_id')->nullable()->constrained('configs')->nullOnDelete()->commit('Tư cách tố tụng');
            $table->string('marriage_certificate_number')->nullable()->comment('Số giấy chứng nhận kết hôn');

            // Thi hanh an
            $table->string('execution_status')->nullable()->comment('Tình trạng thi hành án');
            $table->date('execution_date')->nullable()->comment('Ngày thi hành');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('records', function (Blueprint $table) {
            $table->dropForeign(['judgment_id']);
            $table->dropForeign(['judgment_document_id']);

            $table->dropForeign(['identity_document_id']);
            $table->dropForeign(['nationality_id']);
            $table->dropForeign(['ethnicity_id']);
            $table->dropForeign(['religion_id']);

            $table->dropForeign(['permanent_province_id']);
            $table->dropForeign(['permanent_ward_id']);
            $table->dropForeign(['permanent_old_province_id']);
            $table->dropForeign(['permanent_old_district_id']);
            $table->dropForeign(['permanent_old_ward_id']);

            $table->dropForeign(['hometown_province_id']);
            $table->dropForeign(['hometown_ward_id']);
            $table->dropForeign(['hometown_old_province_id']);
            $table->dropForeign(['hometown_old_district_id']);
            $table->dropForeign(['hometown_old_ward_id']);

            $table->dropForeign(['organization_province_id']);
            $table->dropForeign(['organization_ward_id']);
            $table->dropForeign(['organization_old_province_id']);
            $table->dropForeign(['organization_old_district_id']);
            $table->dropForeign(['organization_old_ward_id']);

            $table->dropForeign(['foreign_identity_document_id']);
            $table->dropForeign(['judicial_measure_name_id']);
            $table->dropForeign(['legal_relationship_id']);
            $table->dropForeign(['litigation_status_id']);
        });
        Schema::dropIfExists('records');
    }
};
