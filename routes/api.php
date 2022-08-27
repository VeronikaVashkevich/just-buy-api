<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Guest
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/products', [ProductController::class, 'index']);


// Authenticated
Route::middleware('auth:api')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::post('/cart/{product}', [CartController::class, 'add']);
    Route::get('/cart', [CartController::class, 'show']);
});

// Admin
Route::middleware(['auth:api', 'adminCheck'])->apiResource('product', ProductController::class)->only([
    'store',
    'update',
    'destroy'
]);
