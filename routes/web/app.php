<?php

use App\Http\Controllers\Web\FileManage\CustomDeleteController;
use App\Http\Controllers\Web\Home\Conversation\ConversationController;
use App\Http\Controllers\Web\Home\Conversation\ConversationMemberController;
use App\Http\Controllers\Web\Home\Conversation\MessageController;
use App\Http\Controllers\Web\Home\Course\CourseTypeController;
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFileManager\Lfm;
use App\Http\Controllers\Web\FileManage\CustomUploadController;
use App\Http\Controllers\Web\FileManage\CustomItemsController;
use App\Http\Controllers\Web\IndexController;
use App\Http\Controllers\Web\Home\LanguageController;
use App\Http\Controllers\Web\Home\Address\WardController;
use App\Http\Controllers\Web\Home\OldAddress\OldDistrictController;
use App\Http\Controllers\Web\Home\OldAddress\OldWardController;
use App\Http\Controllers\Web\Home\Center\ClassroomController;
use App\Http\Controllers\Web\Home\AccountController;
use App\Http\Controllers\Web\Home\Category\TopicController;
use App\Http\Controllers\Web\Home\Category\CategoryController;
use App\Http\Controllers\Web\Home\Product\CategoryAttributeController;
use App\Http\Controllers\Web\Home\Product\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('/')->middleware('global')->group(function () {
    Route::get('', [IndexController::class, 'index'])->name('index');

    Route::prefix('root')->group(base_path('routes/web/root.php'));

    Route::prefix('admin')->group(base_path('routes/web/admin.php'));

    Route::prefix('customer')->group(base_path('routes/web/customer.php'));

    Route::prefix('file-manager')->group(function () {
        Lfm::routes();
        Route::post('upload', [CustomUploadController::class, 'upload'])->name('lfm.upload');
        Route::post('upload-folder', [CustomUploadController::class, 'uploadFolder'])->name('lfm.upload_folder');
        Route::get('jsonitems', [CustomItemsController::class, 'getItems'])->name('lfm.getItems');
        Route::get('delete', [CustomDeleteController::class, 'getDelete'])->name('lfm.getDelete');
    });

    Route::prefix('/')->group(function () {
        Route::prefix('language')->group(function () {
            Route::get('{locale}/change', [LanguageController::class, 'change'])->name('language.change');
        });

        Route::prefix('account')->group(function () {
            Route::get('login', [AccountController::class, 'login'])->name('account.login');
        });

        Route::prefix('category')->group(function () {
            Route::get('get-parent-by-module', [CategoryController::class, 'getParentByModule'])->name('category.get_parent_by_module');
        });

        Route::prefix('topic')->group(function () {
            Route::get('get-by-category', [TopicController::class, 'getByCategory'])->name('topic.get_by_category');
        });

        Route::prefix('ward')->group(function () {
            Route::get('get-by-province', [WardController::class, 'getByProvince'])->name('ward.get_by_province');
        });

        Route::prefix('old-district')->group(function () {
            Route::get('get-by-old-province', [OldDistrictController::class, 'getByOldProvince'])->name('old_district.get_by_old_province');
        });

        Route::prefix('old-ward')->group(function () {
            Route::get('get-by-old-district', [OldWardController::class, 'getByOldDistrict'])->name('old_ward.get_by_old_district');
        });

        Route::prefix('classroom')->group(function () {
            Route::get('get-by-center', [ClassroomController::class, 'getByCenter'])->name('classroom.get_by_center');
        });

        Route::prefix('course-type')->group(function () {
            Route::get('{course_type}/show', [CourseTypeController::class, 'show'])->name('course_type.show');
        });

        Route::prefix('product')->group(function () {
            Route::get('{product}/show', [ProductController::class, 'show'])->name('product.show');
        });

        Route::prefix('category-attribute')->group(function () {
            Route::get('get-by-category', [CategoryAttributeController::class, 'getByCategory'])->name('category_attribute.get_by_category');
        });

        Route::prefix('conversation')->group(function () {
            Route::get('create', [ConversationController::class, 'create'])->name('conversation.create');
            Route::get('filter-conversation', [ConversationController::class, 'filterConversation'])->name('conversation.filter_conversation');
            Route::post('store', [ConversationController::class, 'store'])->name('conversation.store');
            Route::get('{conversation}/edit', [ConversationController::class, 'edit'])->name('conversation.edit');
            Route::patch('{conversation}/update', [ConversationController::class, 'update'])->name('conversation.update');

            Route::get('{conversation}/read', [ConversationController::class, 'read'])->name('conversation.read');
            Route::get('{conversation}/unread', [ConversationController::class, 'unread'])->name('conversation.unread');

            Route::delete('{conversation}/destroy', [ConversationController::class, 'destroy'])->name('conversation.destroy');
        });

        Route::prefix('conversation-member')->group(function () {
            Route::get('filter-modal', [ConversationMemberController::class, 'filterModal'])->name('conversation_member.filter_modal');
            Route::get('filter', [ConversationMemberController::class, 'filter'])->name('conversation_member.filter');
            Route::get('create', [ConversationMemberController::class, 'create'])->name('conversation_member.create');
            Route::post('store', [ConversationMemberController::class, 'store'])->name('conversation_member.store');

            Route::delete('{conversation_member}/destroy', [ConversationMemberController::class, 'destroy'])->name('conversation_member.destroy');
            Route::delete('destroy-many', [ConversationMemberController::class, 'destroyMany'])->name('conversation_member.destroy_many');
            Route::delete('{conversation_member}/update-last-delete-at', [ConversationMemberController::class, 'updateLastDeleteAt'])->name('conversation_member.update_last_delete_at');
        });

        Route::prefix('message')->group(function () {
            Route::get('', [MessageController::class, 'index'])->name('message.index');
            Route::get('filter-card', [MessageController::class, 'filterCard'])->name('message.filter_card');
            Route::get('filter-message', [MessageController::class, 'filterMessage'])->name('message.filter_message');
            Route::post('store', [MessageController::class, 'store'])->name('message.store');

            Route::delete('{message}/destroy', [MessageController::class, 'destroy'])->name('message.destroy');
        });
    });
});
