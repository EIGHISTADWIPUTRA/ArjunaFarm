<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\TestController;
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

// Route publik
Route::post('/login', [AuthController::class, 'login']);

// Route terlindungi
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/test', [TestController::class, 'test']);

    // Route admin (menggunakan middleware role)
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin-test', [TestController::class, 'adminOnly']);
    });
});
