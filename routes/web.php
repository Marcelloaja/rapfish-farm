<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarouselUtamaController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('login', [AuthController::class, 'index']);
Route::post('login', [AuthController::class, 'AuthenticateLogin']);

Route::get('register', [AuthController::class, 'index_register']);
Route::post('register', [AuthController::class, 'RegisterSave']);

Route::get('logout', [AuthController::class, 'logout']);

Route::get('', [DashboardController::class, 'landing_page']);

Route::group(['middleware' => ['CheckSession:1'], 'prefix' => 'admin'], function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard_admin']);

    // Route::get('user', [UserController::class, 'index']);
    // Route::post('save-user', [UserController::class, 'save_user']);
    // Route::post('edit-user', [UserController::class, 'edit_user']);
    // Route::get('delete-user/{id}', [UserController::class, 'delete_user']);

    Route::get('carousel_utama', [CarouselUtamaController::class, 'index']);
    Route::post('save-cu', [CarouselUtamaController::class, 'saveCu'])->name('admin.save-cu');
    Route::post('edit-cu', [CarouselUtamaController::class, 'editCu'])->name('admin.edit-cu');
    Route::get('delete-cu/{id}', [CarouselUtamaController::class, 'deleteCu'])->name('admin.delete-cu');

    Route::get('store', [StoreController::class, 'index']);
    Route::post('save-ds', [StoreController::class, 'saveDs'])->name('admin.save-ds');
    Route::post('edit-ds', [StoreController::class, 'editDs'])->name('admin.edit-ds');
    Route::get('delete-ds/{id}', [StoreController::class, 'deleteDs'])->name('admin.delete-ds');
});
