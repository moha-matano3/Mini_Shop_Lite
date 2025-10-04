<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\AuthController;


Route::post('/login', [AuthController::class, 'login']);
Route::get('/products', [ProductApiController::class, 'index']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/orders', [OrderApiController::class, 'store']);
    Route::post('/logout', [AuthController::class, 'logout']);
});