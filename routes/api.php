<?php
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FoodController;
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
Route::post('/tables/DateTime', [TableController::class, 'availableTimes']); // lấy ra g iờ trống của bàn theo ngày và số lượng người
// routes/api.php
Route::get('/orders', [OrderController::class, 'index']);              // Lấy danh sách đơn đặt
Route::post('/reservation', [OrderController::class, 'store']);             // Tạo đơn đặt mới



// Order
Route::get('/orders/{id}', [OrderController::class, 'show']);
Route::patch('/updateStatus-order/{id}/status', [OrderController::class, 'updateStatus']); // Cập nhật trạng thái
Route::delete('/delete-order/{id}', [OrderController::class, 'destroy']);    // Xoá đơn đặt
Route::post('/orders/bookTables', [OrderController::class, 'bookTables']);// Đặt bàn mới và có thể đặt mnh đơn



// food
Route::get('/food', [FoodController::class, 'index']);
Route::post('insert-food', [FoodController::class, 'store']);
Route::put('food-update/{id}', [FoodController::class, 'update']);
Route::delete('food-delete/{id}', [FoodController::class, 'destroy']);
Route::get('/food/category/{id}', [FoodController::class, 'getFoodsByCategory']);

// category
Route::get('/category', [CategoryController::class, 'index']);
Route::post('insert-category', [CategoryController::class, 'store']);
Route::put('category-update/{id}', [CategoryController::class, 'update']);
Route::delete('category-delete/{id}', [CategoryController::class, 'destroy']);


Route::get('/stat-food', [FoodController::class, "stats"]);
// cate
Route::get('/category', [CategoryController::class, "index"]);
//
Route::get('auth/google/redirect', [GoogleController::class, 'redirect']);
Route::put('food/{id}', [FoodController::class, 'update']);
// customer



Route::post('/login', [CustomerController::class, "login"]);
Route::post('/register', [CustomerController::class, "store"]);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [CustomerController::class, 'index']);
    Route::get('/logout', [CustomerController::class, 'destroy']);
});

// login Google


Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink']);
Route::post('/reset-password', [ResetPasswordController::class, 'reset']);



// đơn hàng
Route::get('/orderRecent', [OrderController::class, 'getOrder']);
Route::get('/statsDashbroad', [OrderController::class, 'statsDashbroad']);

Route::get('auth/google/redirect', [GoogleController::class, 'redirect']);
Route::get('auth/google/callback', [GoogleController::class, 'callback']);
?>
