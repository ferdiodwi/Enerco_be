<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    /**
     * List businesses
     */
    public function index(Request $request): JsonResponse
    {
        $query = Business::with(['user', 'region']);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('sector', 'like', "%{$search}%");
            });
        }

        if ($request->has('sector')) {
            $query->where('sector', $request->sector);
        }

        if ($request->has('verification_status')) {
            $query->where('verification_status', $request->verification_status);
        }

        if ($request->has('region_id')) {
            $query->where('region_id', $request->region_id);
        }

        $businesses = $query->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'message' => 'Data UMKM berhasil diambil',
            'data' => $businesses,
        ]);
    }

    /**
     * FR-BUS-001 Create business profile
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'sector' => 'required|string|max:100',
            'description' => 'required|string',
            'address' => 'required|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'employee_count' => 'required|integer|min:1',
            'production_capacity' => 'required|numeric|min:0',
            'monthly_energy_need' => 'required|numeric|min:0',
            'current_energy_cost' => 'required|numeric|min:0',
            'clean_energy_access' => 'required|boolean',
            'region_id' => 'nullable|exists:regions,id',
            'photo' => 'nullable|image|max:2048',
        ]);

        $validated['user_id'] = $request->user()->id;
        $validated['verification_status'] = 'pending';

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('businesses', 'public');
        }

        $business = Business::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Profil UMKM berhasil dibuat',
            'data' => $business->load(['user', 'region']),
        ], 201);
    }

    /**
     * FR-BUS-003 Show business
     */
    public function show(Business $business): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail UMKM berhasil diambil',
            'data' => $business->load(['user', 'region', 'energyNeeds', 'products', 'latestPriorityScore']),
        ]);
    }

    /**
     * FR-BUS-002 Update business
     */
    public function update(Request $request, Business $business): JsonResponse
    {
        $user = $request->user();

        if ($user->id !== $business->user_id && !$user->hasRole('admin')) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk mengubah data ini',
            ], 403);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:150',
            'sector' => 'sometimes|string|max:100',
            'description' => 'sometimes|string',
            'address' => 'sometimes|string',
            'latitude' => 'sometimes|numeric|between:-90,90',
            'longitude' => 'sometimes|numeric|between:-180,180',
            'employee_count' => 'sometimes|integer|min:1',
            'production_capacity' => 'sometimes|numeric|min:0',
            'monthly_energy_need' => 'sometimes|numeric|min:0',
            'current_energy_cost' => 'sometimes|numeric|min:0',
            'clean_energy_access' => 'sometimes|boolean',
            'region_id' => 'nullable|exists:regions,id',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('businesses', 'public');
        }

        $business->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Profil UMKM berhasil diubah',
            'data' => $business->load(['user', 'region']),
        ]);
    }

    /**
     * FR-BUS-005 Delete business
     */
    public function destroy(Request $request, Business $business): JsonResponse
    {
        $user = $request->user();

        if ($user->id !== $business->user_id && !$user->hasRole('admin')) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses',
            ], 403);
        }

        $business->delete();

        return response()->json([
            'success' => true,
            'message' => 'UMKM berhasil dihapus',
        ]);
    }

    /**
     * FR-BUS-004 Validate/verify business (Admin)
     */
    public function verify(Request $request, Business $business): JsonResponse
    {
        $validated = $request->validate([
            'verification_status' => 'required|in:pending,verified,rejected',
        ]);

        $business->update(['verification_status' => $validated['verification_status']]);

        return response()->json([
            'success' => true,
            'message' => 'Status verifikasi UMKM berhasil diubah',
            'data' => $business,
        ]);
    }
}
