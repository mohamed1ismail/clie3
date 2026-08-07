<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DashboardStatsController;
use App\Http\Controllers\Api\DishController;
use App\Http\Controllers\Api\OfferController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\SocialLinkController;
use App\Http\Controllers\Api\TableController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public Authentication
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Public Menu & Ordering Endpoints
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);

Route::get('/dishes', [DishController::class, 'index']);
Route::get('/dishes/{dish}', [DishController::class, 'show']);

Route::get('/offers', [OfferController::class, 'index']);
Route::get('/offers/{offer}', [OfferController::class, 'show']);

Route::get('/social-links', [SocialLinkController::class, 'index']);

Route::post('/orders', [OrderController::class, 'store']);
Route::get('/orders', [OrderController::class, 'index']); // supports polling ?since=timestamp
Route::get('/orders/{order}', [OrderController::class, 'show']);

// Admin Protected Endpoints (Sanctum Auth)
Route::middleware(['auth:sanctum'])->group(function () {
    // Auth Profile & Logout
    Route::post('/admin/logout', [AuthController::class, 'logout']);
    Route::get('/admin/me', [AuthController::class, 'me']);

    // Admin Dashboard Stats
    Route::get('/admin/dashboard-stats', DashboardStatsController::class);

    // Admin Category Management
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{category}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

    // Admin Dish Management
    Route::post('/dishes', [DishController::class, 'store']);
    Route::put('/dishes/{dish}', [DishController::class, 'update']);
    Route::delete('/dishes/{dish}', [DishController::class, 'destroy']);

    // Admin Table & QR Code Management
    Route::get('/tables', [TableController::class, 'index']);
    Route::post('/tables', [TableController::class, 'store']);
    Route::get('/tables/{table}', [TableController::class, 'show']);
    Route::put('/tables/{table}', [TableController::class, 'update']);
    Route::delete('/tables/{table}', [TableController::class, 'destroy']);
    Route::get('/tables/{table}/qrcode', [TableController::class, 'qrcode']);

    // Admin Order Management
    Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus']);

    // Admin Offer Management
    Route::post('/offers', [OfferController::class, 'store']);
    Route::put('/offers/{offer}', [OfferController::class, 'update']);
    Route::delete('/offers/{offer}', [OfferController::class, 'destroy']);

    // Admin Social Links Management
    Route::put('/social-links', [SocialLinkController::class, 'update']);
});
