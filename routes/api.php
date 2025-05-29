<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/tables', [TableController::class, 'index']);        // List
Route::get('/tables/{id}', [TableController::class, 'show']);    // Detail
Route::post('/tables', [TableController::class, 'store']);       // Create
Route::put('/tables/{id}', [TableController::class, 'update']);  // Update
Route::delete('/tables/{id}', [TableController::class, 'destroy']); // Delete
Route::post('/tables/available-times', [TableController::class, 'availableTimes']); // Delete

// routes/api.php
Route::get('/orders', [OrderController::class, 'index']);              // Lấy danh sách đơn đặt
Route::post('/reservation', [OrderController::class, 'store']);             // Tạo đơn đặt mới

// Chi tiết, cập nhật, xoá
Route::get('/orders/{id}', [OrderController::class, 'show']);          // Lấy chi tiết đơn
Route::patch('/updateStatus-order/{id}/status', [OrderController::class, 'updateStatus']); // Cập nhật trạng thái
Route::delete('/delete-order/{id}', [OrderController::class, 'destroy']);    // Xoá đơn đặt



// menu
Route::get('/menu', [MenuController::class, 'index']);
Route::post('insert-menu', [MenuController::class, 'store']);
Route::put('menu-update/{id}', [MenuController::class, 'update']);
Route::delete('menu-delete/{id}', [MenuController::class, 'destroy']);

// category
Route::get('/category', [CategoryController::class, 'index']);
Route::post('insert-category', [CategoryController::class, 'store']);
Route::put('category-update/{id}', [CategoryController::class, 'update']);
Route::delete('category-delete/{id}', [CategoryController::class, 'destroy']);


Route::get('/stat-menu', [MenuController::class, "stats"]);
// cate
Route::get('/category', [CategoryController::class, "index"]);
//
Route::get('auth/google/redirect', [GoogleController::class, 'redirect']);
Route::put('menu/{id}', [MenuController::class, 'update']);
Route::delete('menu/{id}', [MenuController::class, 'destroy']);
// customer
Route::post('/login', [CustomerController::class, "login"]);
Route::post('/register', [CustomerController::class, "store"]);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [CustomerController::class, 'index']);
    Route::get('/logout', [CustomerController::class, 'destroy']);
});

// login Google
Route::post('/orders/book-tables', [OrderController::class, 'bookTables']);


Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink']);
Route::post('/reset-password', [ResetPasswordController::class, 'reset']);



// đơn hàng
Route::get('/orderRecent', [OrderController::class, 'getOrder']);
Route::get('/statsDashbroad', [OrderController::class, 'statsDashbroad']);

Route::get('auth/google/redirect', [GoogleController::class, 'redirect']);
Route::get('auth/google/callback', [GoogleController::class, 'callback']);
// voucher
Route::get('/voucher', [\App\Http\Controllers\VoucherController::class, 'index']); // lấy all
Route::post('/voucher', [\App\Http\Controllers\VoucherController::class, 'store']); // tạo mới
Route::get('/voucher/{id}', [\App\Http\Controllers\VoucherController::class, 'show']); // lấy chi tiết
Route::put('/voucher/{id}', [\App\Http\Controllers\VoucherController::class, 'update']); // cập nhật
Route::delete('/voucher/{id}', [\App\Http\Controllers\VoucherController::class, 'destroy']); // xoá

Route::post('/applyVoucher', [\App\Http\Controllers\OrderController::class, 'applyVoucher']);
