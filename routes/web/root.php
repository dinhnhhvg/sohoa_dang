<?php

use App\Http\Controllers\Web\Root\AuthController;
use App\Http\Controllers\Web\Root\DashboardController;
use App\Http\Controllers\Web\Root\AccountController;
use App\Http\Controllers\Web\Root\MenuController;
use App\Http\Controllers\Web\Root\ActionController;
use App\Http\Controllers\Web\Root\TypeController;
use App\Http\Controllers\Web\Root\StatusController;
use App\Http\Controllers\Web\Root\ConfigController;
use App\Http\Controllers\Web\Root\SettingController;
use App\Http\Controllers\Web\Root\MenuActionController;
use Illuminate\Support\Facades\Route;

Route::get('login', [AuthController::class, 'showLogin'])->name('root.showLogin');
Route::post('login', [AuthController::class, 'login'])->name('root.login');

Route::prefix('/')->middleware('auth:root')->group(function () {
    Route::get('', [DashboardController::class, 'index'])->name('root');
    Route::get('logout', [AuthController::class, 'logout'])->name('root.logout');

    Route::prefix('account')->group(function () {
        Route::get('', [AccountController::class, 'index'])->name('root.account.index');
        Route::get('filter', [AccountController::class, 'filter'])->name('root.account.filter');
        Route::get('create', [AccountController::class, 'create'])->name('root.account.create');
        Route::get('{account}/edit', [AccountController::class, 'edit'])->name('root.account.edit');

        Route::post('store', [AccountController::class, 'store'])->name('root.account.store');
        Route::patch('{account}/update', [AccountController::class, 'update'])->name('root.account.update');
        Route::delete('{account}/destroy', [AccountController::class, 'destroy'])->name('root.account.destroy');
    });

    Route::prefix('menu')->group(function () {
        Route::get('', [MenuController::class, 'index'])->name('root.menu.index');
        Route::get('filter', [MenuController::class, 'filter'])->name('root.menu.filter');
        Route::get('create', [MenuController::class, 'create'])->name('root.menu.create');
        Route::get('{menu}/edit', [MenuController::class, 'edit'])->name('root.menu.edit');

        Route::post('store', [MenuController::class, 'store'])->name('root.menu.store');
        Route::patch('{menu}/update', [MenuController::class, 'update'])->name('root.menu.update');
        Route::delete('{menu}/destroy', [MenuController::class, 'destroy'])->name('root.menu.destroy');
    });

    Route::prefix('action')->group(function () {
        Route::get('', [ActionController::class, 'index'])->name('root.action.index');
        Route::get('filter', [ActionController::class, 'filter'])->name('root.action.filter');
        Route::get('create', [ActionController::class, 'create'])->name('root.action.create');
        Route::get('{action}/edit', [ActionController::class, 'edit'])->name('root.action.edit');

        Route::post('store', [ActionController::class, 'store'])->name('root.action.store');
        Route::patch('{action}/update', [ActionController::class, 'update'])->name('root.action.update');
        Route::delete('{action}/destroy', [ActionController::class, 'destroy'])->name('root.action.destroy');
    });

    Route::prefix('menu-action')->group(function () {
        Route::patch('{menu_action}/update', [MenuActionController::class, 'update'])->name('root.menu_action.update');
        Route::delete('{menu_action}/destroy', [MenuActionController::class, 'destroy'])->name('root.menu_action.destroy');
    });

    // Type start
    Route::prefix('type')->group(function () {
        Route::get('', [TypeController::class, 'index'])->name('root.type.index');
        Route::get('filter', [TypeController::class, 'filter'])->name('root.type.filter');
        Route::get('create', [TypeController::class, 'create'])->name('root.type.create');
        Route::get('{type}/edit', [TypeController::class, 'edit'])->name('root.type.edit');

        Route::post('store', [TypeController::class, 'store'])->name('root.type.store');
        Route::patch('{type}/update', [TypeController::class, 'update'])->name('root.type.update');
        Route::delete('{type}/destroy', [TypeController::class, 'destroy'])->name('root.type.destroy');
    });
    // Type end

    // Status start
    Route::prefix('status')->group(function () {
        Route::get('', [StatusController::class, 'index'])->name('root.status.index');
        Route::get('filter', [StatusController::class, 'filter'])->name('root.status.filter');
        Route::get('create', [StatusController::class, 'create'])->name('root.status.create');
        Route::get('{status}/edit', [StatusController::class, 'edit'])->name('root.status.edit');

        Route::post('store', [StatusController::class, 'store'])->name('root.status.store');
        Route::patch('{status}/update', [StatusController::class, 'update'])->name('root.status.update');
        Route::delete('{status}/destroy', [StatusController::class, 'destroy'])->name('root.status.destroy');
    });
    // Status end

    Route::prefix('config')->group(function () {
        Route::get('', [ConfigController::class, 'index'])->name('root.config.index');

        Route::patch('update', [ConfigController::class, 'update'])->name('root.config.update');
    });

    Route::prefix('setting')->group(function () {
        Route::patch('update-by-key', [SettingController::class, 'updateByKey'])->name('root.setting.update_by_key');
    });
});
