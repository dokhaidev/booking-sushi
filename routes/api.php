<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderTableController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ComboController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/tables', [TableController::class, 'index']);        // List
Route::get('/tables/{id}', [TableController::class, 'show']);    // Detail
Route::post('/tables', [TableController::class, 'store']);       // Create
Route::put('/tables/{id}', [TableController::class, 'update']);  // Update
Route::delete('/tables/{id}', [TableController::class, 'destroy']); // Delete
Route::post('/tables/DateTime', [TableController::class, 'availableTimes']); // lấy ra g iờ trống của bàn theo ngày và số lượng người
Route::get('/tables/token/{token}', [TableController::class, 'getTableInfo']);



// order
Route::get('/orders', [OrderController::class, 'index']);              // Lấy danh sách đơn đặt
Route::get('/orders/{id}', [OrderController::class, 'show']);          // Lấy chi tiết đơn
Route::put('/order/update-status/{id}', [OrderController::class, 'updateStatus']); // Cập nhật trạng thái
Route::delete('/order/delete/{id}', [OrderController::class, 'destroy']);    // Xoá đơn đặt
Route::patch('/orderitems/update-status/{id}', [OrderItemController::class, 'updateStatus']);
Route::post('/orders/bookTables', [OrderController::class, 'bookTables']);
Route::get('/statsDashbroad', [OrderController::class, 'statsDashbroad']);





// combo
Route::get('/combos', [ComboController::class, 'index']); // Lấy danh sách combo
Route::get('/combos/{id}', [ComboController::class, 'show']); // Lấy chi tiết combo
Route::post('/combo/insert-combos', [ComboController::class, 'store']); // Tạo mới combo
Route::put('/combo/update-combo/{id}', [ComboController::class, 'update']); // Cập nhật combo




// food
Route::get('/foods', [FoodController::class, 'index']);
Route::get('foods/category/{categoryId}/groups', [FoodController::class, 'foodsByCategoryWithGroups']);
Route::post('/food/insertfood', [FoodController::class, 'store']);
Route::put('food-update/{id}', [FoodController::class, 'update']);
Route::get('/food/category/{id}', [FoodController::class, 'getFoodsByCategory']);






// category
Route::get('/category', [CategoryController::class, 'index']);
Route::post('insert-category', [CategoryController::class, 'store']);
Route::put('category-update/{id}', [CategoryController::class, 'update']);






// gg
Route::get('auth/google/redirect', [GoogleController::class, 'redirect']);
Route::put('food/{id}', [FoodController::class, 'update']);
// customer





Route::post('/login', [CustomerController::class, "login"]);
Route::post('/register', [CustomerController::class, "store"]);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [CustomerController::class, 'index']);
    Route::get('/logout', [CustomerController::class, 'destroy']);
});
Route::get('admin/customers', [CustomerController::class, 'listAll']);

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink']);
Route::post('/reset-password', [ResetPasswordController::class, 'reset']);





// đơn hàng

Route::get('auth/google/redirect', [GoogleController::class, 'redirect']);
Route::get('auth/google/callback', [GoogleController::class, 'callback']);

// voucher
Route::get('/voucher', [\App\Http\Controllers\VoucherController::class, 'index']); // lấy all

Route::post('/voucher', [\App\Http\Controllers\VoucherController::class, 'store']); // tạo mới
Route::get('/voucher/{id}', [\App\Http\Controllers\VoucherController::class, 'show']); // lấy chi tiết
Route::put('/voucher/{id}', [\App\Http\Controllers\VoucherController::class, 'update']); // cập nhật
Route::delete('/voucher/{id}', [\App\Http\Controllers\VoucherController::class, 'destroy']); // xoá

Route::post('/applyVoucher', [\App\Http\Controllers\VoucherController::class, 'applyVoucher']);

Route::post('/table/info/{token}', [OrderTableController::class, 'getTableInfo']); // kiểm tra bàn
Route::post('/orderItem/add', [OrderItemController::class, 'addItem']);