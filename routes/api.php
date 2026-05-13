<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BusinessController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\EnergySourceController;
use App\Http\Controllers\Api\ImpactReportController;
use App\Http\Controllers\Api\PartnershipRequestController;
use App\Http\Controllers\Api\PriorityScoreController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RecommendationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| EnergEco GlobalChain API Routes
| All routes are prefixed with /api
|
*/

// ============================================================
// Public Routes (No authentication required)
// ============================================================

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public marketplace
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);

// ============================================================
// Protected Routes (Require authentication via Sanctum)
// ============================================================

Route::middleware('auth:sanctum')->group(function () {

    // --- Auth ---
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // --- Dashboard (all authenticated users) ---
    Route::prefix('dashboard')->group(function () {
        Route::get('/summary', [DashboardController::class, 'summary']);
        Route::get('/energy-chart', [DashboardController::class, 'energyChart']);
        Route::get('/impact-chart', [DashboardController::class, 'impactChart']);
        Route::get('/priority-map', [DashboardController::class, 'priorityMap']);
    });

    // --- Businesses (UMKM) ---
    Route::apiResource('businesses', BusinessController::class);

    // --- Energy Sources ---
    Route::apiResource('energy-sources', EnergySourceController::class);

    // --- AI Recommendations (admin & government) ---
    Route::middleware('role:admin,government')->group(function () {
        Route::post('/recommendations/generate', [RecommendationController::class, 'generate']);
        Route::put('/recommendations/{recommendation}/status', [RecommendationController::class, 'updateStatus']);
    });
    Route::get('/recommendations', [RecommendationController::class, 'index']);
    Route::get('/recommendations/{recommendation}', [RecommendationController::class, 'show']);

    // --- Priority Scores ---
    Route::middleware('role:admin,government')->group(function () {
        Route::post('/priority-scores/calculate', [PriorityScoreController::class, 'calculate']);
    });
    Route::get('/priority-scores', [PriorityScoreController::class, 'index']);
    Route::get('/priority-scores/{priorityScore}', [PriorityScoreController::class, 'show']);

    // --- Impact Reports ---
    Route::get('/impact-reports', [ImpactReportController::class, 'index']);
    Route::post('/impact-reports', [ImpactReportController::class, 'store']);
    Route::get('/impact-reports/{impactReport}', [ImpactReportController::class, 'show']);

    // --- Marketplace Products (authenticated CRUD) ---
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);

    // --- Partnership Requests ---
    Route::get('/partnership-requests', [PartnershipRequestController::class, 'index']);
    Route::post('/partnership-requests', [PartnershipRequestController::class, 'store']);
    Route::put('/partnership-requests/{partnershipRequest}/status', [PartnershipRequestController::class, 'updateStatus']);
});
