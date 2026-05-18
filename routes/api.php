<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BusinessController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\DistributionController;
use App\Http\Controllers\Api\EnergyNeedController;
use App\Http\Controllers\Api\EnergySourceController;
use App\Http\Controllers\Api\MapController;
use App\Http\Controllers\Api\PartnershipController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RecommendationController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes - EnergEco GlobalChain
| SRS Section 9: Rancangan API
|--------------------------------------------------------------------------
*/

// ---- Auth (SRS 9.3) ----
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// ---- Public Products (SRS 9.11 - Public/Login) ----
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);

// ---- Public Map (SRS 9.8) ----
Route::get('/map/markers', [MapController::class, 'markers']);
Route::get('/map/priority-areas', [MapController::class, 'priorityAreas']);

// ---- Public Stats ----
Route::get('/dashboard/public-stats', [DashboardController::class, 'publicStats']);

// ---- Protected Routes ----
Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Users (SRS 9.4 - Admin only)
    Route::middleware('role:admin')->group(function () {
        Route::get('/users', [UserController::class, 'index']);
        Route::get('/users/{user}', [UserController::class, 'show']);
        Route::delete('/users/{user}', [UserController::class, 'destroy']);
        Route::patch('/users/{user}/status', [UserController::class, 'updateStatus']);
        Route::patch('/users/{user}/role', [UserController::class, 'updateRole']);
    });

    // Businesses (SRS 9.5)
    Route::get('/businesses', [BusinessController::class, 'index']);
    Route::post('/businesses', [BusinessController::class, 'store']);
    Route::get('/businesses/{business}', [BusinessController::class, 'show']);
    Route::put('/businesses/{business}', [BusinessController::class, 'update']);
    Route::delete('/businesses/{business}', [BusinessController::class, 'destroy']);
    Route::patch('/businesses/{business}/verify', [BusinessController::class, 'verify'])
        ->middleware('role:admin');

    // Energy Sources (SRS 9.6)
    Route::get('/energy-sources', [EnergySourceController::class, 'index']);
    Route::post('/energy-sources', [EnergySourceController::class, 'store']);
    Route::get('/energy-sources/{energySource}', [EnergySourceController::class, 'show']);
    Route::put('/energy-sources/{energySource}', [EnergySourceController::class, 'update']);
    Route::delete('/energy-sources/{energySource}', [EnergySourceController::class, 'destroy'])
        ->middleware('role:admin');
    Route::patch('/energy-sources/{energySource}/capacity', [EnergySourceController::class, 'updateCapacity']);

    // Energy Needs (SRS 9.7)
    Route::get('/energy-needs', [EnergyNeedController::class, 'index']);
    Route::post('/energy-needs', [EnergyNeedController::class, 'store']);
    Route::get('/energy-needs/{energyNeed}', [EnergyNeedController::class, 'show']);
    Route::put('/energy-needs/{energyNeed}', [EnergyNeedController::class, 'update']);
    Route::patch('/energy-needs/{energyNeed}/validate', [EnergyNeedController::class, 'validate_need'])
        ->middleware('role:admin');

    // // Map (SRS 9.8)
    // Route::get('/map/markers', [MapController::class, 'markers']);
    // Route::get('/map/priority-areas', [MapController::class, 'priorityAreas'])
    //     ->middleware('role:admin|government');

    // Recommendations (SRS 9.9)
    Route::get('/recommendations', [RecommendationController::class, 'index']);
    Route::post('/recommendations/generate', [RecommendationController::class, 'generate'])
        ->middleware('role:admin|government');
    Route::get('/recommendations/{recommendation}', [RecommendationController::class, 'show']);
    Route::patch('/recommendations/{recommendation}/status', [RecommendationController::class, 'updateStatus'])
        ->middleware('role:admin|government');

    // Distributions (SRS 9.10)
    Route::get('/distributions', [DistributionController::class, 'index']);
    Route::post('/distributions', [DistributionController::class, 'store']);
    Route::get('/distributions/{distribution}', [DistributionController::class, 'show']);
    Route::put('/distributions/{distribution}', [DistributionController::class, 'update']);
    Route::patch('/distributions/{distribution}/status', [DistributionController::class, 'updateStatus']);

    // Products (SRS 9.11 - Authenticated)
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'destroy']);
    Route::patch('/products/{product}/status', [ProductController::class, 'updateStatus'])
        ->middleware('role:admin');

    // Partnerships (SRS 9.12)
    Route::get('/partnerships', [PartnershipController::class, 'index']);
    Route::post('/partnerships', [PartnershipController::class, 'store']);
    Route::get('/partnerships/{partnership}', [PartnershipController::class, 'show']);
    Route::patch('/partnerships/{partnership}/status', [PartnershipController::class, 'updateStatus']);

    // Dashboard (SRS 5.14)
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->middleware('role:admin');
    Route::get('/dashboard/umkm', [DashboardController::class, 'umkm'])->middleware('role:umkm');
    Route::get('/dashboard/government', [DashboardController::class, 'government'])->middleware('role:government');
    Route::get('/dashboard/provider', [DashboardController::class, 'provider'])->middleware('role:provider');
    Route::get('/dashboard/partner', [DashboardController::class, 'partner'])->middleware('role:partner');
});
