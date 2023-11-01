<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
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
Route::get('/profile', [ProfileController::class, 'index']);
Route::get('/checkout', [CheckoutController::class, 'index']);
Route::resource('products', ProductController::class)->only(['index', 'show']);
Route::get('/login', [AuthController::class, 'login']);
Route::resource('register', RegisterController::class)->only(['index', 'store']);
