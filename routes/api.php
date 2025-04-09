<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MenuController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/tables', [TableController::class, 'index']);        // List
Route::get('/tables/{id}', [TableController::class, 'show']);    // Detail
Route::post('/tables', [TableController::class, 'store']);       // Create
Route::put('/tables/{id}', [TableController::class, 'update']);  // Update
Route::delete('/tables/{id}', [TableController::class, 'destroy']); // Delete



Route::get('/orders', [OrderController::class, 'index']);              // Lấy danh sách đơn đặt
Route::post('/orders', [OrderController::class, 'store']);             // Tạo đơn đặt mới

// 🔍 Chi tiết, cập nhật, xoá
Route::get('/orders/{id}', [OrderController::class, 'show']);          // Lấy chi tiết đơn
Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus']); // Cập nhật trạng thái
Route::delete('/orders/{id}', [OrderController::class, 'destroy']);    // Xoá đơn đặt

// 📆 Lịch theo ngày
Route::get('/orders/date/{date}', [OrderController::class, 'getByDate']);  // Lấy đơn theo ngày

//  Gợi ý bàn
Route::get('/orders/suggest-table', [OrderController::class, 'suggestTable']); // Gợi ý bàn theo số khách

//  Check-in & Check-out
Route::patch('/orders/{id}/check-in', [OrderController::class, 'checkIn']);     // Check-in
Route::patch('/orders/{id}/check-out', [OrderController::class, 'checkOut']);   // Check-out


