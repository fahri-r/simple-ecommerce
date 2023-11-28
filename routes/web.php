<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::resource('profile', ProfileController::class)->only(['index', 'update']);
Route::resource('products', ProductController::class)->only(['index', 'show']);
Route::resource('carts', CartController::class)->only(['index']);
Route::resource('profile.orders', OrderController::class)->only(['index', 'store']);
Route::get('/profile/{profile}/orders/{orders}/invoice', [OrderController::class, 'invoice'])->name('profile.orders.invoice');
Route::get('/profile/{profile}/orders/{orders}/payments/{payments}', [PaymentController::class, 'edit'])->name('profile.orders.payments.edit');
Route::put('/profile/{profile}/orders/{orders}/payments/{payments}', [PaymentController::class, 'update'])->name('profile.orders.payments.update');
Route::resource('login', LoginController::class)->only(['index', 'store']);
Route::resource('register', RegisterController::class)->only(['index', 'store']);
