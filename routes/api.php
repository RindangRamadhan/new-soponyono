<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Order\OrderController;
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

// Auth
Route::prefix('/auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
    // Logout
    Route::get('/auth/logout', [AuthController::class, 'logout']);

    // Orders
    Route::resource('/orders', OrderController::class);
});
