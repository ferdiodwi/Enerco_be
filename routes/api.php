<?php

use App\Http\Controllers\Api\AuthController;
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

// ============================================================
// Protected Routes (Require authentication via Sanctum)
// ============================================================

Route::middleware('auth:sanctum')->group(function () {

    // --- Auth ---
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // --- Dashboard (all authenticated users) ---
    // Route::get('/dashboard/summary', [DashboardController::class, 'summary']);
    // Route::get('/dashboard/energy-chart', [DashboardController::class, 'energyChart']);
    // Route::get('/dashboard/impact-chart', [DashboardController::class, 'impactChart']);
    // Route::get('/dashboard/priority-map', [DashboardController::class, 'priorityMap']);

    // --- Businesses (UMKM) ---
    // Route::apiResource('businesses', BusinessController::class);

    // --- Energy Sources ---
    // Route::apiResource('energy-sources', EnergySourceController::class);

    // --- AI Recommendations ---
    // Route::post('/recommendations/generate', [RecommendationController::class, 'generate']);
    // Route::get('/recommendations', [RecommendationController::class, 'index']);
    // Route::get('/recommendations/{id}', [RecommendationController::class, 'show']);
    // Route::put('/recommendations/{id}/status', [RecommendationController::class, 'updateStatus']);

    // --- Priority Scores ---
    // Route::post('/priority-scores/calculate', [PriorityScoreController::class, 'calculate']);
    // Route::get('/priority-scores', [PriorityScoreController::class, 'index']);
    // Route::get('/priority-scores/{id}', [PriorityScoreController::class, 'show']);

    // --- Impact Reports ---
    // Route::apiResource('impact-reports', ImpactReportController::class)->only(['index', 'store', 'show']);

    // --- Marketplace Products ---
    // Route::apiResource('products', ProductController::class);

    // --- Partnership Requests ---
    // Route::get('/partnership-requests', [PartnershipRequestController::class, 'index']);
    // Route::post('/partnership-requests', [PartnershipRequestController::class, 'store']);
    // Route::put('/partnership-requests/{id}/status', [PartnershipRequestController::class, 'updateStatus']);
});
