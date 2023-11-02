<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->as('api.')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register'])->name("auth.register");
        Route::post('/login', [AuthController::class, 'login'])->name("auth.login");
    });

    Route::apiResource('products', ProductController::class)->only(['index', 'show']);

    Route::middleware('auth:api')->group(function () {
        Route::apiResource('profile.orders', OrderController::class)->only(['index', 'show', 'store']);
        Route::apiResource('profile.orders.payments', PaymentController::class)->only(['index', 'show', 'update']);

        Route::resource('profile', ProfileController::class)->only(['index', 'show', 'update', 'destroy']);
        Route::apiResource('profile.carts', CartController::class)->only(['index', 'show', 'store', 'update', 'destroy']);

        Route::middleware('role:admin')->group(function () {
            Route::apiResource('products', ProductController::class)->only(['store', 'update', 'destroy']);
            Route::apiResource('profile.orders', OrderController::class)->only(['update', 'destroy']);
            Route::apiResource('profile.orders.payments', PaymentController::class)->only(['destroy']);
        });
    });
});
