<?php

use App\Http\Controllers\Web\Admin\Auth\AuthController;
use App\Http\Controllers\Web\Admin\Config\EthnicityController;
use App\Http\Controllers\Web\Admin\Config\NationalityController;
use App\Http\Controllers\Web\Admin\DashboardController;
use App\Http\Controllers\Web\Admin\User\UserController;
use App\Http\Controllers\Web\Admin\User\RoleController;
use App\Http\Controllers\Web\Admin\User\MenuRoleController;
use App\Http\Controllers\Web\Admin\User\RoleMenuActionController;
use App\Http\Controllers\Web\Admin\Customer\CustomerController;
use App\Http\Controllers\Web\Admin\Course\CourseController;
use App\Http\Controllers\Web\Admin\Course\CourseTypeController;
use App\Http\Controllers\Web\Admin\Course\ChapterController;
use App\Http\Controllers\Web\Admin\Course\ChapterVideoController;
use App\Http\Controllers\Web\Admin\Course\ChapterDocumentController;
use App\Http\Controllers\Web\Admin\Class\ClassController;
use App\Http\Controllers\Web\Admin\Class\ClassCustomerController;
use App\Http\Controllers\Web\Admin\Class\LessonScheduleController;
use App\Http\Controllers\Web\Admin\Class\LessonController;
use App\Http\Controllers\Web\Admin\Class\LessonCustomerController;
use App\Http\Controllers\Web\Admin\Resource\FileManageController;
use App\Http\Controllers\Web\Admin\Resource\VideoController;
use App\Http\Controllers\Web\Admin\Resource\ItemMediaController;
use App\Http\Controllers\Web\Admin\Center\CenterController;
use App\Http\Controllers\Web\Admin\Center\ClassroomController;
use App\Http\Controllers\Web\Admin\AgencyController;
use App\Http\Controllers\Web\Admin\OldAgencyController;
use App\Http\Controllers\Web\Admin\Batch\JudgmentController;
use App\Http\Controllers\Web\Admin\Batch\JudgmentDocumentController;
use App\Http\Controllers\Web\Admin\Batch\BatchController;
use App\Http\Controllers\Web\Admin\Batch\WorkDistributionController;
use App\Http\Controllers\Web\Admin\Batch\DefendantController;
use App\Http\Controllers\Web\Admin\Address\ProvinceController;
use App\Http\Controllers\Web\Admin\Address\WardController;
use App\Http\Controllers\Web\Admin\OldAddress\OldProvinceController;
use App\Http\Controllers\Web\Admin\OldAddress\OldDistrictController;
use App\Http\Controllers\Web\Admin\OldAddress\OldWardController;
use App\Http\Controllers\Web\Admin\Setting\SettingController;
use App\Http\Controllers\Web\Admin\Config\LanguageController;
use App\Http\Controllers\Web\Admin\Setting\HolidayController;
use App\Http\Controllers\Web\Admin\Setting\CustomerTagController;
use App\Http\Controllers\Web\Admin\Setting\ChannelController;
use App\Http\Controllers\Web\Admin\Category\CategoryController;
use App\Http\Controllers\Web\Admin\Category\TopicController;
use App\Http\Controllers\Web\Admin\Category\LevelController;
use App\Http\Controllers\Web\Admin\Contact\ContactController;
use App\Http\Controllers\Web\Admin\Order\OrderController;
use App\Http\Controllers\Web\Admin\Order\OrderItemController;
use App\Http\Controllers\Web\Admin\Order\CouponController;
use App\Http\Controllers\Web\Admin\Order\PaymentController;
use App\Http\Controllers\Web\Admin\Setting\PaymentMethodController;
use App\Http\Controllers\Web\Admin\Campaign\CampaignController;
use App\Http\Controllers\Web\Admin\Campaign\CampaignCustomerController;
use App\Http\Controllers\Web\Admin\Log\ImportLogController;
use App\Http\Controllers\Web\Admin\Setting\AlohubExtensionController;
use App\Http\Controllers\Web\Admin\Product\AttributeController;
use App\Http\Controllers\Web\Admin\Product\AttributeValueController;
use App\Http\Controllers\Web\Admin\Product\ProductController;
use App\Http\Controllers\Web\Admin\Config\ConfigController;
use App\Http\Controllers\Web\Admin\Config\ReligionController;
use App\Http\Controllers\Web\Admin\IssuingUnit\PoliceController;
use App\Http\Controllers\Web\Admin\IssuingUnit\ProcuracyController;
use Illuminate\Support\Facades\Route;

Route::get('login', [AuthController::class, 'showLogin'])->name('admin.showLogin');
Route::post('login', [AuthController::class, 'login'])->name('admin.login');

Route::prefix('/')->middleware('auth:user')->group(function () {
    Route::get('', [DashboardController::class, 'index'])->name('admin');
    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');

    Route::prefix('type')->group(function () {
        Route::get('report-batch', [\App\Http\Controllers\Web\Admin\TypeController::class, 'reportBatch'])->name('admin.type.report_batch');
    });

    // User start
    Route::prefix('user')->group(function () {
        Route::get('', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('create', [UserController::class, 'create'])->name('admin.user.create');
        Route::get('filter', [UserController::class, 'filter'])->name('admin.user.filter');
        Route::get('{user}/profile', [UserController::class, 'show'])->name('admin.user.profile');
        Route::get('export', [UserController::class, 'export'])->name('admin.user.export');
        Route::get('{user}/get-note-value', [UserController::class, 'getNoteValue'])->name('admin.user.get_note_value');
        Route::get('{user}/show', [UserController::class, 'show'])->name('admin.user.show');
        Route::get('info', [UserController::class, 'info'])->name('admin.user.info');

        Route::post('store', [UserController::class, 'store'])->name('admin.user.store');
        Route::patch('{user}/update', [UserController::class, 'update'])->name('admin.user.update');
        Route::patch('{user}/update-profile', [UserController::class, 'update'])->name('admin.user.update_profile');
        Route::delete('{user}/destroy', [UserController::class, 'destroy'])->name('admin.user.destroy');

        Route::get('create-import', [UserController::class, 'createImport'])->name('admin.user.create_import');
        Route::get('download-import', [UserController::class, 'downloadImport'])->name('admin.user.download_import');
        Route::post('store-import', [UserController::class, 'storeImport'])->name('admin.user.store_import');
    });

    Route::prefix('role')->group(function () {
        Route::get('', [RoleController::class, 'index'])->name('admin.role.index');
        Route::get('create', [RoleController::class, 'create'])->name('admin.role.create');
        Route::get('filter', [RoleController::class, 'filter'])->name('admin.role.filter');
        Route::get('{role}/edit', [RoleController::class, 'edit'])->name('admin.role.edit');
        Route::get('export', [RoleController::class, 'export'])->name('admin.role.export');

        Route::get('{role}/permission', [RoleController::class, 'permission'])->name('admin.role.permission');
        Route::get('{role}/filter-permission', [RoleController::class, 'filterPermission'])->name('admin.role.filter_permission');

        Route::post('', [RoleController::class, 'store'])->name('admin.role.store');
        Route::patch('{role}/update', [RoleController::class, 'update'])->name('admin.role.update');
        Route::delete('{role}/destroy', [RoleController::class, 'destroy'])->name('admin.role.destroy');
    });

    Route::prefix('menu-role')->group(function () {
        Route::patch('toggle-relation/{menu}/{role}', [MenuRoleController::class, 'toggleRelation'])->name('admin.menu_role.toggle_relation');
    });

    Route::prefix('role-menu-action')->group(function () {
        Route::patch('toggle-relation/{role}/{menu_action}', [RoleMenuActionController::class, 'toggleRelation'])->name('admin.role_menu_action.toggle_relation');
    });
    // User end

    // Customer start
    Route::prefix('customer')->group(function () {
        Route::get('', [CustomerController::class, 'index'])->name('admin.customer.index')->middleware('check_alohub');
        Route::get('create', [CustomerController::class, 'create'])->name('admin.customer.create');
        Route::get('filter', [CustomerController::class, 'filter'])->name('admin.customer.filter');
        Route::get('{customer}/profile', [CustomerController::class, 'show'])->name('admin.customer.profile');
        Route::get('export', [CustomerController::class, 'export'])->name('admin.customer.export');
        Route::get('find-by-phone-and-name', [CustomerController::class, 'findByPhoneAndName'])->name('admin.customer.find_by_phone_and_name');
        Route::get('{customer}/show', [CustomerController::class, 'show'])->name('admin.customer.show');

        Route::get('create-import', [CustomerController::class, 'createImport'])->name('admin.customer.create_import');
        Route::get('download-import', [CustomerController::class, 'downloadImport'])->name('admin.customer.download_import');
        Route::post('store-import', [CustomerController::class, 'storeImport'])->name('admin.customer.store_import');

        Route::post('store', [CustomerController::class, 'store'])->name('admin.customer.store');
        Route::patch('{customer}/update', [CustomerController::class, 'update'])->name('admin.customer.update');
        Route::delete('{customer}/destroy', [CustomerController::class, 'destroy'])->name('admin.customer.destroy');
        Route::delete('destroy-many', [CustomerController::class, 'destroyMany'])->name('admin.customer.destroy_many');
    });
    // Customer end

    // Contact start
    Route::prefix('contact')->group(function () {
        Route::get('', [ContactController::class, 'index'])->name('admin.contact.index')->middleware('check_alohub');
        Route::get('create', [ContactController::class, 'create'])->name('admin.contact.create');
        Route::get('filter', [ContactController::class, 'filter'])->name('admin.contact.filter');
        Route::get('{contact}/edit', [ContactController::class, 'edit'])->name('admin.contact.edit');
        Route::get('{contact}/show-note', [ContactController::class, 'showNote'])->name('admin.contact.show_note');
        Route::get('export', [ContactController::class, 'export'])->name('admin.contact.export');

        Route::post('store', [ContactController::class, 'store'])->name('admin.contact.store');
        Route::delete('destroy-many', [ContactController::class, 'destroyMany'])->name('admin.contact.destroy_many');
        Route::patch('{contact}/update', [ContactController::class, 'update'])->name('admin.contact.update');
        Route::delete('{contact}/destroy', [ContactController::class, 'destroy'])->name('admin.contact.destroy');
    });
    //Contact end

    // Campaign start
    Route::prefix('campaign')->group(function () {
        Route::get('', [CampaignController::class, 'index'])->name('admin.campaign.index');
        Route::get('filter', [CampaignController::class, 'filter'])->name('admin.campaign.filter');
        Route::get('create', [CampaignController::class, 'create'])->name('admin.campaign.create');
        Route::get('{campaign}/detail', [CampaignController::class, 'detail'])->name('admin.campaign.detail')->middleware('check_alohub');
        Route::get('{campaign}/edit', [CampaignController::class, 'edit'])->name('admin.campaign.edit');
//        Route::get('{campaign}/report', [CampaignController::class, 'report'])->name('admin.campaign.report');
        Route::get('{campaign}/show', [CampaignController::class, 'show'])->name('admin.campaign.show');
        Route::get('export', [CampaignController::class, 'export'])->name('admin.campaign.export');

        Route::post('store', [CampaignController::class, 'store'])->name('admin.campaign.store');
        Route::patch('{campaign}/update', [CampaignController::class, 'update'])->name('admin.campaign.update');
        Route::delete('{campaign}/destroy', [CampaignController::class, 'destroy'])->name('admin.campaign.destroy');
    });

    Route::prefix('campaign-customer')->group(function () {
        Route::get('filter-card', [CampaignCustomerController::class, 'filterCard'])->name('admin.campaign_customer.filter_card');
        Route::get('filter', [CampaignCustomerController::class, 'filter'])->name('admin.campaign_customer.filter');
        Route::get('edit-sale-many', [CampaignCustomerController::class, 'editSaleMany'])->name('admin.campaign_customer.edit_sale_many');
        Route::get('export', [CampaignCustomerController::class, 'export'])->name('admin.campaign_customer.export');
        Route::get('{campaign_customer}/edit', [CampaignCustomerController::class, 'edit'])->name('admin.campaign_customer.edit');
        Route::get('{campaign_customer}/show-note', [CampaignCustomerController::class, 'ShowNote'])->name('admin.campaign_customer.show_note');

        Route::patch('update-many', [CampaignCustomerController::class, 'updateMany'])->name('admin.campaign_customer.update_many');
        Route::delete('destroy-many', [CampaignCustomerController::class, 'destroyMany'])->name('admin.campaign_customer.destroy_many');
        Route::patch('{campaign_customer}/update', [CampaignCustomerController::class, 'update'])->name('admin.campaign_customer.update');
        Route::delete('{campaign_customer}/destroy', [CampaignController::class, 'destroy'])->name('admin.campaign_customer.destroy');

        Route::get('create-import', [CampaignCustomerController::class, 'createImport'])->name('admin.campaign_customer.create_import');
        Route::get('download-import', [CampaignCustomerController::class, 'downloadImport'])->name('admin.campaign_customer.download_import');
        Route::post('store-import', [CampaignCustomerController::class, 'storeImport'])->name('admin.campaign_customer.store_import');

        Route::get('create-many', [CampaignCustomerController::class, 'createMany'])->name('admin.campaign_customer.create_many');
        Route::post('store-many', [CampaignCustomerController::class, 'storeMany'])->name('admin.campaign_customer.store_many');
    });
    // Campaign end

    // Order start
    Route::prefix('order')->group(function () {
        Route::get('', [OrderController::class, 'index'])->name('admin.order.index')->middleware('check_alohub');
        Route::get('create', [OrderController::class, 'create'])->name('admin.order.create');
        Route::get('filter', [OrderController::class, 'filter'])->name('admin.order.filter');
        Route::get('{order}/edit', [OrderController::class, 'edit'])->name('admin.order.edit');
        Route::get('{order}/show-note', [OrderController::class, 'showNote'])->name('admin.order.show_note');
        Route::get('export', [OrderController::class, 'export'])->name('admin.order.export');

        Route::post('store', [OrderController::class, 'store'])->name('admin.order.store');
        Route::delete('destroy-many', [OrderController::class, 'destroyMany'])->name('admin.order.destroy_many');
        Route::post('use-coupon', [OrderController::class, 'useCoupon'])->name('admin.order.use_coupon');
        Route::post('use-discount-amount', [OrderController::class, 'useDiscountAmount'])->name('admin.order.use_discount_amount');
        Route::patch('{order}/update', [OrderController::class, 'update'])->name('admin.order.update');
        Route::delete('{order}/destroy', [OrderController::class, 'destroy'])->name('admin.order.destroy');
    });

    Route::prefix('order-item')->group(function () {
        Route::get('filter-modal', [OrderItemController::class, 'filterModal'])->name('admin.order_item.filter_modal');
        Route::get('filter', [OrderItemController::class, 'filter'])->name('admin.order_item.filter');
        Route::get('create', [OrderItemController::class, 'create'])->name('admin.order_item.create');
        Route::get('{order_item}/edit', [OrderItemController::class, 'edit'])->name('admin.order_item.edit');
        Route::post('', [OrderItemController::class, 'store'])->name('admin.order_item.store');
        Route::patch('{order_item}/update', [OrderItemController::class, 'update'])->name('admin.order_item.update');
        Route::delete('{order_item}/destroy', [OrderItemController::class, 'destroy'])->name('admin.order_item.destroy');
    });

    Route::prefix('payment')->group(function () {
        Route::get('', [PaymentController::class, 'index'])->name('admin.payment.index');
        Route::get('filter-modal', [PaymentController::class, 'filterModal'])->name('admin.payment.filter_modal');
        Route::get('filter', [PaymentController::class, 'filter'])->name('admin.payment.filter');
        Route::get('create', [PaymentController::class, 'create'])->name('admin.payment.create');
        Route::get('{payment}/edit', [PaymentController::class, 'edit'])->name('admin.payment.edit');
        Route::get('{payment}/show_note', [PaymentController::class, 'showNote'])->name('admin.payment.show_note');
        Route::get('export', [PaymentController::class, 'export'])->name('admin.payment.export');

        Route::post('store', [PaymentController::class, 'store'])->name('admin.payment.store');
        Route::patch('{payment}/update', [PaymentController::class, 'update'])->name('admin.payment.update');
        Route::delete('{payment}/destroy', [PaymentController::class, 'destroy'])->name('admin.payment.destroy');
        Route::delete('destroy-many', [PaymentController::class, 'destroyMany'])->name('admin.payment.destroy_many');
    });

    Route::prefix('coupon')->group(function () {
        Route::get('', [CouponController::class, 'index'])->name('admin.coupon.index');
        Route::get('create', [CouponController::class, 'create'])->name('admin.coupon.create');
        Route::get('filter', [CouponController::class, 'filter'])->name('admin.coupon.filter');
        Route::get('{coupon}/edit', [CouponController::class, 'edit'])->name('admin.coupon.edit');
        Route::get('export', [CouponController::class, 'export'])->name('admin.coupon.export');

        Route::get('{coupon}/history/filter-modal', [CouponController::class, 'history'])->name('admin.coupon.history.filter_modal');
        Route::get('{coupon}/history/filter', [CouponController::class, 'historyFilter'])->name('admin.coupon.history.filter');

        Route::post('store', [CouponController::class, 'store'])->name('admin.coupon.store');
        Route::delete('destroy-many', [CouponController::class, 'destroyMany'])->name('admin.coupon.destroy_many');
        Route::patch('{coupon}/update', [CouponController::class, 'update'])->name('admin.coupon.update');
        Route::delete('{coupon}/destroy', [CouponController::class, 'destroy'])->name('admin.coupon.destroy');
    });
    // Order end

    // Course start
    Route::prefix('course')->group(function () {
        Route::get('', [CourseController::class, 'index'])->name('admin.course.index');
        Route::get('create', [CourseController::class, 'create'])->name('admin.course.create');
        Route::get('filter', [CourseController::class, 'filter'])->name('admin.course.filter');
        Route::get('{course}/detail', [CourseController::class, 'detail'])->name('admin.course.detail');
        Route::get('{course}/edit', [CourseController::class, 'edit'])->name('admin.course.edit');
        Route::get('export', [CourseController::class, 'export'])->name('admin.course.export');
        Route::get('{course}/show', [CourseController::class, 'show'])->name('admin.course.show');

        Route::post('store', [CourseController::class, 'store'])->name('admin.course.store');
        Route::patch('{course}/update', [CourseController::class, 'update'])->name('admin.course.update');
        Route::delete('{course}/destroy', [CourseController::class, 'destroy'])->name('admin.course.destroy');
    });

    Route::prefix('course-type')->group(function () {
        Route::get('', [CourseTypeController::class, 'index'])->name('admin.course_type.index');
        Route::get('filter-card', [CourseTypeController::class, 'filterCard'])->name('admin.course_type.filter_card');
        Route::get('create', [CourseTypeController::class, 'create'])->name('admin.course_type.create');
        Route::get('filter', [CourseTypeController::class, 'filter'])->name('admin.course_type.filter');
        Route::get('{course_type}/edit', [CourseTypeController::class, 'edit'])->name('admin.course_type.edit');

        Route::post('store', [CourseTypeController::class, 'store'])->name('admin.course_type.store');
        Route::patch('{course_type}/update', [CourseTypeController::class, 'update'])->name('admin.course_type.update');
        Route::delete('{course_type}/destroy', [CourseTypeController::class, 'destroy'])->name('admin.course_type.destroy');
    });

    Route::prefix('chapter')->group(function () {
        Route::get('filter-card', [ChapterController::class, 'filterCard'])->name('admin.chapter.filter_card');
        Route::get('create', [ChapterController::class, 'create'])->name('admin.chapter.create');
        Route::get('filter', [ChapterController::class, 'filter'])->name('admin.chapter.filter');
        Route::get('{chapter}/edit', [ChapterController::class, 'edit'])->name('admin.chapter.edit');

        Route::post('store', [ChapterController::class, 'store'])->name('admin.chapter.store');
        Route::patch('{chapter}/update', [ChapterController::class, 'update'])->name('admin.chapter.update');
        Route::delete('{chapter}/destroy', [ChapterController::class, 'destroy'])->name('admin.chapter.destroy');
    });

    Route::prefix('chapter-video')->group(function () {
        Route::get('create', [ChapterVideoController::class, 'create'])->name('admin.chapter_video.create');
        Route::get('{chapter_video}/edit', [ChapterVideoController::class, 'edit'])->name('admin.chapter_video.edit');

        Route::post('store', [ChapterVideoController::class, 'store'])->name('admin.chapter_video.store');
        Route::patch('{chapter_video}/update', [ChapterVideoController::class, 'update'])->name('admin.chapter_video.update');
        Route::delete('{chapter_video}/destroy', [ChapterVideoController::class, 'destroy'])->name('admin.chapter_video.destroy');
    });

    Route::prefix('chapter-document')->group(function () {
        Route::get('create', [ChapterDocumentController::class, 'create'])->name('admin.chapter_document.create');
        Route::get('{chapter_document}/edit', [ChapterDocumentController::class, 'edit'])->name('admin.chapter_document.edit');

        Route::post('store', [ChapterDocumentController::class, 'store'])->name('admin.chapter_document.store');
        Route::patch('{chapter_document}/update', [ChapterDocumentController::class, 'update'])->name('admin.chapter_document.update');
        Route::delete('{chapter_document}/destroy', [ChapterDocumentController::class, 'destroy'])->name('admin.chapter_document.destroy');
    });
    // Course end

    // Class start
    Route::prefix('class')->group(function () {
        Route::get('', [ClassController::class, 'index'])->name('admin.class.index');
        Route::get('create', [ClassController::class, 'create'])->name('admin.class.create');
        Route::get('filter', [ClassController::class, 'filter'])->name('admin.class.filter');
        Route::get('{class}/detail', [ClassController::class, 'detail'])->name('admin.class.detail');
        Route::get('{class}/edit', [ClassController::class, 'edit'])->name('admin.class.edit');
        Route::get('export', [ClassController::class, 'export'])->name('admin.class.export');
        Route::get('{class}/show', [ClassController::class, 'show'])->name('admin.class.show');

        Route::post('store', [ClassController::class, 'store'])->name('admin.class.store');
        Route::patch('{class}/update', [ClassController::class, 'update'])->name('admin.class.update');
        Route::delete('{class}/destroy', [ClassController::class, 'destroy'])->name('admin.class.destroy');
    });

    Route::prefix('class-customer')->group(function () {
        Route::get('filter-card', [ClassCustomerController::class, 'filterCard'])->name('admin.class_customer.filter_card');
        Route::get('create', [ClassCustomerController::class, 'create'])->name('admin.class_customer.create');
        Route::get('filter', [ClassCustomerController::class, 'filter'])->name('admin.class_customer.filter');
        Route::get('{class_customer}/edit', [ClassCustomerController::class, 'edit'])->name('admin.class_customer.edit');
        Route::get('export', [ClassCustomerController::class, 'export'])->name('admin.class_customer.export');

        Route::get('edit-end-date-many', [ClassCustomerController::class, 'editEndDateMany'])->name('admin.class_customer.edit_end_date_many');
        Route::get('edit-status-many', [ClassCustomerController::class, 'editStatusMany'])->name('admin.class_customer.edit_status_many');
        Route::patch('update-many', [ClassCustomerController::class, 'updateMany'])->name('admin.class_customer.update_many');

        Route::post('store', [ClassCustomerController::class, 'store'])->name('admin.class_customer.store');
        Route::patch('{class_customer}/update', [ClassCustomerController::class, 'update'])->name('admin.class_customer.update');
        Route::delete('{class_customer}/destroy', [ClassCustomerController::class, 'destroy'])->name('admin.class_customer.destroy');
    });

    Route::prefix('lesson-schedule')->group(function () {
        Route::get('filter-card', [LessonScheduleController::class, 'filterCard'])->name('admin.lesson_schedule.filter_card');
        Route::get('create', [LessonScheduleController::class, 'create'])->name('admin.lesson_schedule.create');
        Route::get('create-lesson', [LessonScheduleController::class, 'createLesson'])->name('admin.lesson_schedule.create_lesson');
        Route::get('filter', [LessonScheduleController::class, 'filter'])->name('admin.lesson_schedule.filter');
        Route::get('{lesson_schedule}/edit', [LessonScheduleController::class, 'edit'])->name('admin.lesson_schedule.edit');

        Route::post('store', [LessonScheduleController::class, 'store'])->name('admin.lesson_schedule.store');
        Route::post('expected-schedule', [LessonScheduleController::class, 'expectedSchedule'])->name('admin.lesson_schedule.expected_schedule');
        Route::post('store-lesson', [LessonScheduleController::class, 'storeLesson'])->name('admin.lesson_schedule.store_lesson');
        Route::delete('destroy-many', [LessonScheduleController::class, 'destroyMany'])->name('admin.lesson_schedule.destroy_many');
        Route::patch('{lesson_schedule}/update', [LessonScheduleController::class, 'update'])->name('admin.lesson_schedule.update');
        Route::delete('{lesson_schedule}/destroy', [LessonScheduleController::class, 'destroy'])->name('admin.lesson_schedule.destroy');
    });

    Route::prefix('lesson')->group(function () {
        Route::get('filter-card', [LessonController::class, 'filterCard'])->name('admin.lesson.filter_card');
        Route::get('create', [LessonController::class, 'create'])->name('admin.lesson.create');
        Route::get('filter', [LessonController::class, 'filter'])->name('admin.lesson.filter');
        Route::get('{lesson}/edit', [LessonController::class, 'edit'])->name('admin.lesson.edit');
        Route::get('export', [LessonController::class, 'export'])->name('admin.lesson.export');

        Route::post('store', [LessonController::class, 'store'])->name('admin.lesson.store');
        Route::delete('destroy-many', [LessonController::class, 'destroyMany'])->name('admin.lesson.destroy_many');
        Route::patch('{lesson}/update', [LessonController::class, 'update'])->name('admin.lesson.update');
        Route::delete('{lesson}/destroy', [LessonController::class, 'destroy'])->name('admin.lesson.destroy');
    });

    Route::prefix('lesson-customer')->group(function () {
        Route::get('filter-modal', [LessonCustomerController::class, 'filterModal'])->name('admin.lesson_customer.filter_modal');
        Route::get('create', [LessonCustomerController::class, 'create'])->name('admin.lesson_customer.create');
        Route::get('filter', [LessonCustomerController::class, 'filter'])->name('admin.lesson_customer.filter');
        Route::get('export', [LessonCustomerController::class, 'export'])->name('admin.lesson_customer.export');

        Route::get('create-many', [LessonCustomerController::class, 'createMany'])->name('admin.lesson_customer.create_many');
        Route::post('store-many', [LessonCustomerController::class, 'storeMany'])->name('admin.lesson_customer.store_many');

        Route::post('store', [LessonCustomerController::class, 'store'])->name('admin.lesson_customer.store');
        Route::post('update-many', [LessonCustomerController::class, 'updateMany'])->name('admin.lesson_customer.update_many');
        Route::delete('{lesson_customer}/destroy', [LessonCustomerController::class, 'destroy'])->name('admin.lesson_customer.destroy');
        Route::delete('destroy-many', [LessonCustomerController::class, 'destroyMany'])->name('admin.lesson_customer.destroy_many');
    });
    // Class end

    // Product start
    Route::prefix('attribute')->group(function () {
        Route::get('', [AttributeController::class, 'index'])->name('admin.attribute.index');
        Route::get('filter', [AttributeController::class, 'filter'])->name('admin.attribute.filter');
        Route::get('create', [AttributeController::class, 'create'])->name('admin.attribute.create');
        Route::get('{attribute}/edit', [AttributeController::class, 'edit'])->name('admin.attribute.edit');

        Route::post('store', [AttributeController::class, 'store'])->name('admin.attribute.store');
        Route::patch('{attribute}/update', [AttributeController::class, 'update'])->name('admin.attribute.update');
        Route::delete('{attribute}/destroy', [AttributeController::class, 'destroy'])->name('admin.attribute.destroy');
    });

    Route::prefix('attribute-value')->group(function () {
        Route::get('create', [AttributeValueController::class, 'create'])->name('admin.attribute_value.create');
        Route::get('{attribute_value}/edit', [AttributeValueController::class, 'edit'])->name('admin.attribute_value.edit');

        Route::post('store', [AttributeValueController::class, 'store'])->name('admin.attribute_value.store');
        Route::patch('{attribute_value}/update', [AttributeValueController::class, 'update'])->name('admin.attribute_value.update');
        Route::delete('{attribute_value}/destroy', [AttributeValueController::class, 'destroy'])->name('admin.attribute_value.destroy');
    });

    Route::prefix('product')->group(function () {
        Route::get('', [ProductController::class, 'index'])->name('admin.product.index');
        Route::get('filter', [ProductController::class, 'filter'])->name('admin.product.filter');
        Route::get('create', [ProductController::class, 'create'])->name('admin.product.create');
        Route::get('{product}/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::get('{product}/detail', [ProductController::class, 'detail'])->name('admin.product.detail');
        Route::get('{product}/show', [ProductController::class, 'show'])->name('admin.product.show');

        Route::post('store', [ProductController::class, 'store'])->name('admin.product.store');
        Route::patch('{product}/update', [ProductController::class, 'update'])->name('admin.product.update');
        Route::delete('{product}/destroy', [ProductController::class, 'destroy'])->name('admin.product.destroy');
    });

    Route::prefix('item-media')->group(function () {
        Route::get('filter-card', [ItemMediaController::class, 'filterCard'])->name('admin.item_media.filter_card');
        Route::get('filter', [ItemMediaController::class, 'filter'])->name('admin.item_media.filter');
        Route::get('create', [ItemMediaController::class, 'create'])->name('admin.item_media.create');
        Route::get('{item_media}/edit', [ItemMediaController::class, 'edit'])->name('admin.item_media.edit');

        Route::post('store', [ItemMediaController::class, 'store'])->name('admin.item_media.store');
        Route::patch('{item_media}/update', [ItemMediaController::class, 'update'])->name('admin.item_media.update');
        Route::delete('{item_media}/destroy', [ItemMediaController::class, 'destroy'])->name('admin.item_media.destroy');
    });
    // Product end

    // Resource start
    Route::prefix('file-manage')->group(function () {
        Route::get('', [FileManageController::class, 'index'])->name('admin.file_manage.index');
    });

    Route::prefix('video')->group(function () {
        Route::get('', [VideoController::class, 'index'])->name('admin.video.index');
        Route::get('create', [VideoController::class, 'create'])->name('admin.video.create');
        Route::get('filter', [VideoController::class, 'filter'])->name('admin.video.filter');
        Route::get('{video}/edit', [VideoController::class, 'edit'])->name('admin.video.edit');
        Route::get('export', [VideoController::class, 'export'])->name('admin.video.export');
        Route::get('{video}/show', [VideoController::class, 'show'])->name('admin.video.show');

        Route::post('store', [VideoController::class, 'store'])->name('admin.video.store');
        Route::post('store-many', [VideoController::class, 'storeMany'])->name('admin.video.store_many');
        Route::patch('{video}/update', [VideoController::class, 'update'])->name('admin.video.update');
        Route::delete('{video}/destroy', [VideoController::class, 'destroy'])->name('admin.video.destroy');
    });
    // Resource end

    // Center start
    Route::prefix('center')->group(function () {
        Route::get('', [CenterController::class, 'index'])->name('admin.center.index');
        Route::get('create', [CenterController::class, 'create'])->name('admin.center.create');
        Route::get('filter', [CenterController::class, 'filter'])->name('admin.center.filter');
        Route::get('{center}/edit', [CenterController::class, 'edit'])->name('admin.center.edit');
        Route::get('export', [CenterController::class, 'export'])->name('admin.center.export');

        Route::post('store', [CenterController::class, 'store'])->name('admin.center.store');
        Route::patch('{center}/update', [CenterController::class, 'update'])->name('admin.center.update');
        Route::delete('{center}/destroy', [CenterController::class, 'destroy'])->name('admin.center.destroy');
    });

    Route::prefix('classroom')->group(function () {
        Route::get('', [ClassroomController::class, 'index'])->name('admin.classroom.index');
        Route::get('create', [ClassroomController::class, 'create'])->name('admin.classroom.create');
        Route::get('filter', [ClassroomController::class, 'filter'])->name('admin.classroom.filter');
        Route::get('{classroom}/edit', [ClassroomController::class, 'edit'])->name('admin.classroom.edit');
        Route::get('export', [ClassroomController::class, 'export'])->name('admin.classroom.export');

        Route::post('store', [ClassroomController::class, 'store'])->name('admin.classroom.store');
        Route::patch('{classroom}/update', [ClassroomController::class, 'update'])->name('admin.classroom.update');
        Route::delete('{classroom}/destroy', [ClassroomController::class, 'destroy'])->name('admin.classroom.destroy');
    });
    // Center end

    // Category start
    Route::prefix('category')->group(function () {
        Route::get('', [CategoryController::class, 'index'])->name('admin.category.index');
        Route::get('create', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::get('filter', [CategoryController::class, 'filter'])->name('admin.category.filter');
        Route::get('{category}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');

        Route::post('store', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::patch('{category}/update', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::delete('{category}/destroy', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
    });

    Route::prefix('topic')->group(function () {
        Route::get('create', [TopicController::class, 'create'])->name('admin.topic.create');
        Route::get('{topic}/edit', [TopicController::class, 'edit'])->name('admin.topic.edit');

        Route::post('store', [TopicController::class, 'store'])->name('admin.topic.store');
        Route::patch('{topic}/update', [TopicController::class, 'update'])->name('admin.topic.update');
        Route::delete('{topic}/destroy', [TopicController::class, 'destroy'])->name('admin.topic.destroy');
    });

    Route::prefix('level')->group(function () {
        Route::get('', [LevelController::class, 'index'])->name('admin.level.index');
        Route::get('create', [LevelController::class, 'create'])->name('admin.level.create');
        Route::get('filter', [LevelController::class, 'filter'])->name('admin.level.filter');
        Route::get('{level}/edit', [LevelController::class, 'edit'])->name('admin.level.edit');

        Route::post('store', [LevelController::class, 'store'])->name('admin.level.store');
        Route::patch('{level}/update', [LevelController::class, 'update'])->name('admin.level.update');
        Route::delete('{level}/destroy', [LevelController::class, 'destroy'])->name('admin.level.destroy');
    });
    // Category end

    // Agency start
    Route::prefix('agency')->group(function () {
        Route::get('', [AgencyController::class, 'index'])->name('admin.agency.index');
        Route::get('create', [AgencyController::class, 'create'])->name('admin.agency.create');
        Route::get('filter', [AgencyController::class, 'filter'])->name('admin.agency.filter');
        Route::get('{agency}/edit', [AgencyController::class, 'edit'])->name('admin.agency.edit');
        Route::get('export', [AgencyController::class, 'export'])->name('admin.agency.export');

        Route::post('store', [AgencyController::class, 'store'])->name('admin.agency.store');
        Route::patch('{agency}/update', [AgencyController::class, 'update'])->name('admin.agency.update');
        Route::delete('{agency}/destroy', [AgencyController::class, 'destroy'])->name('admin.agency.destroy');
    });

    Route::prefix('old-agency')->group(function () {
        Route::get('', [OldAgencyController::class, 'index'])->name('admin.old_agency.index');
        Route::get('create', [OldAgencyController::class, 'create'])->name('admin.old_agency.create');
        Route::get('filter', [OldAgencyController::class, 'filter'])->name('admin.old_agency.filter');
        Route::get('{old_agency}/edit', [OldAgencyController::class, 'edit'])->name('admin.old_agency.edit');
        Route::get('export', [OldAgencyController::class, 'export'])->name('admin.old_agency.export');

        Route::post('store', [OldAgencyController::class, 'store'])->name('admin.old_agency.store');
        Route::patch('{old_agency}/update', [OldAgencyController::class, 'update'])->name('admin.old_agency.update');
        Route::delete('{old_agency}/destroy', [OldAgencyController::class, 'destroy'])->name('admin.old_agency.destroy');
    });

    Route::prefix('police')->group(function () {
        Route::get('', [PoliceController::class, 'index'])->name('admin.police.index');
        Route::get('create', [PoliceController::class, 'create'])->name('admin.police.create');
        Route::get('filter', [PoliceController::class, 'filter'])->name('admin.police.filter');
        Route::get('{police}/edit', [PoliceController::class, 'edit'])->name('admin.police.edit');

        Route::post('store', [PoliceController::class, 'store'])->name('admin.police.store');
        Route::patch('{police}/update', [PoliceController::class, 'update'])->name('admin.police.update');
        Route::delete('{police}/destroy', [PoliceController::class, 'destroy'])->name('admin.police.destroy');

        Route::get('create-import', [PoliceController::class, 'createImport'])->name('admin.police.create_import');
        Route::get('download-import', [PoliceController::class, 'downloadImport'])->name('admin.police.download_import');
        Route::post('store-import', [PoliceController::class, 'storeImport'])->name('admin.police.store_import');
        Route::get('export', [PoliceController::class, 'export'])->name('admin.police.export');
    });

    Route::prefix('procuracy')->group(function () {
        Route::get('', [ProcuracyController::class, 'index'])->name('admin.procuracy.index');
        Route::get('create', [ProcuracyController::class, 'create'])->name('admin.procuracy.create');
        Route::get('filter', [ProcuracyController::class, 'filter'])->name('admin.procuracy.filter');
        Route::get('{procuracy}/edit', [ProcuracyController::class, 'edit'])->name('admin.procuracy.edit');

        Route::post('store', [ProcuracyController::class, 'store'])->name('admin.procuracy.store');
        Route::patch('{procuracy}/update', [ProcuracyController::class, 'update'])->name('admin.procuracy.update');
        Route::delete('{procuracy}/destroy', [ProcuracyController::class, 'destroy'])->name('admin.procuracy.destroy');

        Route::get('create-import', [ProcuracyController::class, 'createImport'])->name('admin.procuracy.create_import');
        Route::get('download-import', [ProcuracyController::class, 'downloadImport'])->name('admin.procuracy.download_import');
        Route::post('store-import', [ProcuracyController::class, 'storeImport'])->name('admin.procuracy.store_import');
        Route::get('export', [ProcuracyController::class, 'export'])->name('admin.procuracy.export');

    });

    Route::prefix('batch')->group(function () {
        Route::get('', [BatchController::class, 'index'])->name('admin.batch.index');
        Route::get('filter-card', [BatchController::class, 'filterCard'])->name('admin.batch.filter_card');
        Route::get('create', [BatchController::class, 'create'])->name('admin.batch.create');
        Route::get('filter', [BatchController::class, 'filter'])->name('admin.batch.filter');
        Route::get('{batch}/detail', [BatchController::class, 'detail'])->name('admin.batch.detail');
        Route::get('{batch}/show', [BatchController::class, 'show'])->name('admin.batch.show');
        Route::get('{batch}/detail', [BatchController::class, 'detail'])->name('admin.batch.detail');
        Route::get('{batch}/edit', [BatchController::class, 'edit'])->name('admin.batch.edit');
        Route::get('export', [BatchController::class, 'export'])->name('admin.batch.export');

        Route::post('store', [BatchController::class, 'store'])->name('admin.batch.store');
        Route::patch('{batch}/update', [BatchController::class, 'update'])->name('admin.batch.update');
        Route::delete('{batch}/destroy', [BatchController::class, 'destroy'])->name('admin.batch.destroy');

        Route::get('{batch}/report-card', [BatchController::class, 'reportCard'])->name('admin.batch.report_card');
        Route::get('report-entry', [BatchController::class, 'reportEntry'])->name('admin.batch.report_entry');
        Route::get('report-check', [BatchController::class, 'reportCheck'])->name('admin.batch.report_check');

        Route::get('{batch}/report-date-card', [BatchController::class, 'reportDateCard'])->name('admin.batch.report_date_card');
        Route::get('report-date-filter', [BatchController::class, 'reportDateFilter'])->name('admin.batch.report_date_filter');

        Route::get('{batch}/export-detail', [BatchController::class, 'exportDetail'])->name('admin.batch.export_detail');

        Route::get('report_user', [BatchController::class, 'reportUser'])->name('admin.batch.report_user');
        Route::get('report-user-filter', [BatchController::class, 'reportUserFilter'])->name('admin.batch.report_user_filter');
    });

    Route::prefix('work-distribution')->group(function () {
        Route::get('', [WorkDistributionController::class, 'index'])->name('admin.work_distribution.index');
        Route::get('filter', [WorkDistributionController::class, 'filter'])->name('admin.work_distribution.filter');

        Route::post('{work_distribution}/handle', [WorkDistributionController::class, 'handle'])->name('admin.work_distribution.handle');
    });

    Route::prefix('judgment')->group(function () {
        Route::get('', [JudgmentController::class, 'index'])->name('admin.judgment.index');
        Route::get('filter-card', [JudgmentController::class, 'filterCard'])->name('admin.judgment.filter_card');
        Route::get('filter', [JudgmentController::class, 'filter'])->name('admin.judgment.filter');
        Route::get('{judgment}/detail', [JudgmentController::class, 'detail'])->name('admin.judgment.detail');
        Route::get('{judgment}/edit', [JudgmentController::class, 'edit'])->name('admin.judgment.edit');
        Route::get('export', [JudgmentController::class, 'export'])->name('admin.judgment.export');
        Route::get('{judgment}/show-note', [JudgmentController::class, 'showNote'])->name('admin.judgment.show_note');

        Route::get('report-card', [JudgmentController::class, 'reportCard'])->name('admin.judgment.report_card');
        Route::get('report-filter', [JudgmentController::class, 'reportFilter'])->name('admin.judgment.report_filter');

        Route::post('store', [JudgmentController::class, 'store'])->name('admin.judgment.store');
        Route::patch('{judgment}/update', [JudgmentController::class, 'update'])->name('admin.judgment.update');

        Route::get('show-work-distribution', [JudgmentController::class, 'showWorkDistribution'])->name('admin.judgment.show_work_distribution');
        Route::post('work-distribution', [JudgmentController::class, 'workDistribution'])->name('admin.judgment.work_distribution');

        Route::delete('destroy-many-entry', [JudgmentController::class, 'destroyManyEntry'])->name('admin.judgment.destroy_many_entry');
        Route::delete('destroy-many-checker', [JudgmentController::class, 'destroyManyChecker'])->name('admin.judgment.destroy_many_checker');

        Route::get('updateHvg', [JudgmentController::class, 'updateHvg'])->name('admin.judgment.updateHvg');
    });

    Route::prefix('judgment-document')->group(function () {
        Route::get('', [JudgmentDocumentController::class, 'index'])->name('admin.judgment_document.index');
        Route::get('filter-modal', [JudgmentDocumentController::class, 'filterModal'])->name('admin.judgment_document.filter_modal');
        Route::get('filter', [JudgmentDocumentController::class, 'filter'])->name('admin.judgment_document.filter');
        Route::get('{judgment_document}/edit', [JudgmentDocumentController::class, 'edit'])->name('admin.judgment_document.edit');
        Route::get('{judgment_document}/show-note', [JudgmentDocumentController::class, 'showNote'])->name('admin.judgment_document.show_note');

        Route::get('edit-by-file-path', [JudgmentDocumentController::class, 'editByFilePath'])->name('admin.judgment_document.edit_by_file_path');

        Route::patch('{judgment_document}/update', [JudgmentDocumentController::class, 'update'])->name('admin.judgment_document.update');

        Route::get('{judgment_document}/show-copy-defendant', [JudgmentDocumentController::class, 'showCopyDefendant'])->name('admin.judgment_document.show_copy_defendant');
        Route::post('{judgment_document}/copy-defendant', [JudgmentDocumentController::class, 'copyDefendant'])->name('admin.judgment_document.copy_defendant');

        Route::post('update-pdf2', [JudgmentDocumentController::class, 'updatePdf2'])->name('admin.judgment_document.update_pdf2');
    });

    Route::prefix('defendant')->group(function () {
        Route::get('', [DefendantController::class, 'index'])->name('admin.defendant.index');
        Route::post('store', [DefendantController::class, 'store'])->name('admin.defendant.store');
        Route::delete('{defendant}/destroy', [DefendantController::class, 'destroy'])->name('admin.defendant.destroy');
    });
    // Agency end

    // Address start
    Route::prefix('province')->group(function () {
        Route::get('', [ProvinceController::class, 'index'])->name('admin.province.index');
        Route::get('create', [ProvinceController::class, 'create'])->name('admin.province.create');
        Route::get('filter', [ProvinceController::class, 'filter'])->name('admin.province.filter');
        Route::get('{province}/edit', [ProvinceController::class, 'edit'])->name('admin.province.edit');
        Route::get('export', [ProvinceController::class, 'export'])->name('admin.province.export');

        Route::post('store', [ProvinceController::class, 'store'])->name('admin.province.store');
        Route::patch('{province}/update', [ProvinceController::class, 'update'])->name('admin.province.update');
        Route::delete('{province}/destroy', [ProvinceController::class, 'destroy'])->name('admin.province.destroy');
    });

    Route::prefix('ward')->group(function () {
        Route::get('', [WardController::class, 'index'])->name('admin.ward.index');
        Route::get('create', [WardController::class, 'create'])->name('admin.ward.create');
        Route::get('filter', [WardController::class, 'filter'])->name('admin.ward.filter');
        Route::get('{ward}/edit', [WardController::class, 'edit'])->name('admin.ward.edit');
        Route::get('export', [WardController::class, 'export'])->name('admin.ward.export');

        Route::post('store', [WardController::class, 'store'])->name('admin.ward.store');
        Route::patch('{ward}/update', [WardController::class, 'update'])->name('admin.ward.update');
        Route::delete('{ward}/destroy', [WardController::class, 'destroy'])->name('admin.ward.destroy');
    });

    Route::prefix('old-province')->group(function () {
        Route::get('', [OldProvinceController::class, 'index'])->name('admin.old_province.index');
        Route::get('create', [OldProvinceController::class, 'create'])->name('admin.old_province.create');
        Route::get('filter', [OldProvinceController::class, 'filter'])->name('admin.old_province.filter');
        Route::get('{old_province}/edit', [OldProvinceController::class, 'edit'])->name('admin.old_province.edit');
        Route::get('export', [OldProvinceController::class, 'export'])->name('admin.old_province.export');

        Route::post('store', [OldProvinceController::class, 'store'])->name('admin.old_province.store');
        Route::patch('{old_province}/update', [OldProvinceController::class, 'update'])->name('admin.old_province.update');
        Route::delete('{old_province}/destroy', [OldProvinceController::class, 'destroy'])->name('admin.old_province.destroy');
    });

    Route::prefix('old-district')->group(function () {
        Route::get('', [OldDistrictController::class, 'index'])->name('admin.old_district.index');
        Route::get('create', [OldDistrictController::class, 'create'])->name('admin.old_district.create');
        Route::get('filter', [OldDistrictController::class, 'filter'])->name('admin.old_district.filter');
        Route::get('{old_district}/edit', [OldDistrictController::class, 'edit'])->name('admin.old_district.edit');
        Route::get('export', [OldDistrictController::class, 'export'])->name('admin.old_district.export');

        Route::post('store', [OldDistrictController::class, 'store'])->name('admin.old_district.store');
        Route::patch('{old_district}/update', [OldDistrictController::class, 'update'])->name('admin.old_district.update');
        Route::delete('{old_district}/destroy', [OldDistrictController::class, 'destroy'])->name('admin.old_district.destroy');
    });

    Route::prefix('old-ward')->group(function () {
        Route::get('', [OldWardController::class, 'index'])->name('admin.old_ward.index');
        Route::get('create', [OldWardController::class, 'create'])->name('admin.old_ward.create');
        Route::get('filter', [OldWardController::class, 'filter'])->name('admin.old_ward.filter');
        Route::get('{old_ward}/edit', [OldWardController::class, 'edit'])->name('admin.old_ward.edit');
        Route::get('export', [OldWardController::class, 'export'])->name('admin.old_ward.export');

        Route::post('store', [OldWardController::class, 'store'])->name('admin.old_ward.store');
        Route::patch('{old_ward}/update', [OldWardController::class, 'update'])->name('admin.old_ward.update');
        Route::delete('{old_ward}/destroy', [OldWardController::class, 'destroy'])->name('admin.old_ward.destroy');
    });
    // Address end

    // Config start
    $configPrefixes = [
        'config',
        'physical_condition',
        'identity_document',
        'foreign_identity_document',
        'document_type', 'penalty',
        'judgment_type',
        'judicial_measure_name',
        'judicial_measure_issuer',
        'legal_relationship',
        'litigation_status',
        'marital_status',
        'copy_type',
        'confidentiality_level',
        'document_genre',
        'retention_period',
        'tenure_period',
        'font',
        'usage_mode'
    ];
    foreach ($configPrefixes as $prefix) {
        Route::prefix(str_replace('_', '-', $prefix))->group(function () use ($prefix) {
            Route::get('', [ConfigController::class, 'index'])->name('admin.'.$prefix.'.index');
            Route::get('create', [ConfigController::class, 'create'])->name('admin.'.$prefix.'.create');
            Route::get('filter', [ConfigController::class, 'filter'])->name('admin.'.$prefix.'.filter');
            Route::get('{config}/edit', [ConfigController::class, 'edit'])->name('admin.'.$prefix.'.edit');

            Route::post('store', [ConfigController::class, 'store'])->name('admin.'.$prefix.'.store');
            Route::patch('{config}/update', [ConfigController::class, 'update'])->name('admin.'.$prefix.'.update');

            Route::delete('{config}/destroy', [ConfigController::class, 'destroy'])->name('admin.'.$prefix.'.destroy');
            Route::delete('destroy-many', [ConfigController::class, 'destroyMany'])->name('admin.'.$prefix.'.destroy_many');

            Route::get('create-import', [ConfigController::class, 'createImport'])->name('admin.'.$prefix.'.create_import');
            Route::get('download-import', [ConfigController::class, 'downloadImport'])->name('admin.'.$prefix.'.download_import');
            Route::post('store-import', [ConfigController::class, 'storeImport'])->name('admin.'.$prefix.'.store_import');
            Route::get('export', [ConfigController::class, 'export'])->name('admin.'.$prefix.'.export');
        });
    }

    Route::prefix('nationality')->group(function () {
        Route::get('', [NationalityController::class, 'index'])->name('admin.nationality.index');
        Route::get('create', [NationalityController::class, 'create'])->name('admin.nationality.create');
        Route::get('filter', [NationalityController::class, 'filter'])->name('admin.nationality.filter');
        Route::get('{nationality}/edit', [NationalityController::class, 'edit'])->name('admin.nationality.edit');

        Route::post('store', [NationalityController::class, 'store'])->name('admin.nationality.store');
        Route::patch('{nationality}/update', [NationalityController::class, 'update'])->name('admin.nationality.update');
        Route::delete('{nationality}/destroy', [NationalityController::class, 'destroy'])->name('admin.nationality.destroy');
    });

    Route::prefix('ethnicity')->group(function () {
        Route::get('', [EthnicityController::class, 'index'])->name('admin.ethnicity.index');
        Route::get('create', [EthnicityController::class, 'create'])->name('admin.ethnicity.create');
        Route::get('filter', [EthnicityController::class, 'filter'])->name('admin.ethnicity.filter');
        Route::get('{ethnicity}/edit', [EthnicityController::class, 'edit'])->name('admin.ethnicity.edit');

        Route::post('store', [EthnicityController::class, 'store'])->name('admin.ethnicity.store');
        Route::patch('{ethnicity}/update', [EthnicityController::class, 'update'])->name('admin.ethnicity.update');
        Route::delete('{ethnicity}/destroy', [EthnicityController::class, 'destroy'])->name('admin.ethnicity.destroy');
    });

    Route::prefix('language')->group(function () {
        Route::get('', [LanguageController::class, 'index'])->name('admin.language.index');
        Route::get('filter', [LanguageController::class, 'filter'])->name('admin.language.filter');
        Route::get('create', [LanguageController::class, 'create'])->name('admin.language.create');
        Route::get('{language}/edit', [LanguageController::class, 'edit'])->name('admin.language.edit');

        Route::post('store', [LanguageController::class, 'store'])->name('admin.language.store');
        Route::patch('{language}/update', [LanguageController::class, 'update'])->name('admin.language.update');
        Route::delete('{language}/destroy', [LanguageController::class, 'destroy'])->name('admin.language.destroy');

        Route::get('{locale}/show', [LanguageController::class, 'show'])->name('admin.language.show');
        Route::get('{locale}/filter-message', [LanguageController::class, 'filterMessage'])->name('admin.language.filter_message');
        Route::patch('{locale}/update-message', [LanguageController::class, 'updateMessage'])->name('admin.language.update_message');
    });

    Route::prefix('religion')->group(function () {
        Route::get('', [ReligionController::class, 'index'])->name('admin.religion.index');
        Route::get('create', [ReligionController::class, 'create'])->name('admin.religion.create');
        Route::get('filter', [ReligionController::class, 'filter'])->name('admin.religion.filter');
        Route::get('{religion}/edit', [ReligionController::class, 'edit'])->name('admin.religion.edit');

        Route::post('store', [ReligionController::class, 'store'])->name('admin.religion.store');
        Route::patch('{religion}/update', [ReligionController::class, 'update'])->name('admin.religion.update');
        Route::delete('{religion}/destroy', [ReligionController::class, 'destroy'])->name('admin.religion.destroy');
    });
    // Config end

    // Setting start
    Route::prefix('setting')->group(function () {
        Route::get('', [SettingController::class, 'index'])->name('admin.setting.index');
        Route::patch('update', [SettingController::class, 'update'])->name('admin.setting.update');
    });

    Route::prefix('holiday')->group(function () {
        Route::get('', [HolidayController::class, 'index'])->name('admin.holiday.index');
        Route::get('create', [HolidayController::class, 'create'])->name('admin.holiday.create');
        Route::get('filter', [HolidayController::class, 'filter'])->name('admin.holiday.filter');
        Route::get('{holiday}/edit', [HolidayController::class, 'edit'])->name('admin.holiday.edit');

        Route::post('store', [HolidayController::class, 'store'])->name('admin.holiday.store');
        Route::patch('{holiday}/update', [HolidayController::class, 'update'])->name('admin.holiday.update');
        Route::delete('{holiday}/destroy', [HolidayController::class, 'destroy'])->name('admin.holiday.destroy');
    });

    Route::prefix('customer-tag')->group(function () {
        Route::get('', [CustomerTagController::class, 'index'])->name('admin.customer_tag.index');
        Route::get('create', [CustomerTagController::class, 'create'])->name('admin.customer_tag.create');
        Route::get('filter', [CustomerTagController::class, 'filter'])->name('admin.customer_tag.filter');
        Route::get('{customer_tag}/edit', [CustomerTagController::class, 'edit'])->name('admin.customer_tag.edit');

        Route::post('store', [CustomerTagController::class, 'store'])->name('admin.customer_tag.store');
        Route::patch('{customer_tag}/update', [CustomerTagController::class, 'update'])->name('admin.customer_tag.update');
        Route::delete('{customer_tag}/destroy', [CustomerTagController::class, 'destroy'])->name('admin.customer_tag.destroy');
    });

    Route::prefix('channel')->group(function () {
        Route::get('', [ChannelController::class, 'index'])->name('admin.channel.index');
        Route::get('create', [ChannelController::class, 'create'])->name('admin.channel.create');
        Route::get('filter', [ChannelController::class, 'filter'])->name('admin.channel.filter');
        Route::get('{channel}/edit', [ChannelController::class, 'edit'])->name('admin.channel.edit');

        Route::post('store', [ChannelController::class, 'store'])->name('admin.channel.store');
        Route::patch('{channel}/update', [ChannelController::class, 'update'])->name('admin.channel.update');
        Route::delete('{channel}/destroy', [ChannelController::class, 'destroy'])->name('admin.channel.destroy');
    });

    Route::prefix('payment-method')->group(function () {
        Route::get('', [PaymentMethodController::class, 'index'])->name('admin.payment_method.index');
        Route::get('create', [PaymentMethodController::class, 'create'])->name('admin.payment_method.create');
        Route::get('filter', [PaymentMethodController::class, 'filter'])->name('admin.payment_method.filter');
        Route::get('{payment_method}/edit', [PaymentMethodController::class, 'edit'])->name('admin.payment_method.edit');

        Route::post('store', [PaymentMethodController::class, 'store'])->name('admin.payment_method.store');
        Route::patch('{payment_method}/update', [PaymentMethodController::class, 'update'])->name('admin.payment_method.update');
        Route::delete('{payment_method}/destroy', [PaymentMethodController::class, 'destroy'])->name('admin.payment_method.destroy');
    });

    Route::prefix('alohub-extension')->group(function () {
        Route::get('create', [AlohubExtensionController::class, 'create'])->name('admin.alohub_extension.create');
        Route::get('filter', [AlohubExtensionController::class, 'filter'])->name('admin.alohub_extension.filter');
        Route::get('{alohub_extension}/edit', [AlohubExtensionController::class, 'edit'])->name('admin.alohub_extension.edit');

        Route::post('store', [AlohubExtensionController::class, 'store'])->name('admin.alohub_extension.store');
        Route::patch('{alohub_extension}/update', [AlohubExtensionController::class, 'update'])->name('admin.alohub_extension.update');
        Route::delete('{alohub_extension}/destroy', [AlohubExtensionController::class, 'destroy'])->name('admin.alohub_extension.destroy');
    });
    // Setting end

    // Log start
    Route::prefix('import-log')->group(function () {
        Route::get('', [ImportLogController::class, 'index'])->name('admin.import_log.index');
        Route::get('filter', [ImportLogController::class, 'filter'])->name('admin.import_log.filter');
        Route::get('{import_log}/show', [ImportLogController::class, 'show'])->name('admin.import_log.show');
    });
    // Log end
});
