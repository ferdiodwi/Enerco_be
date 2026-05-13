<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PartnershipRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PartnershipRequestController extends Controller
{
    /**
     * Display a listing of partnership requests.
     *
     * GET /api/partnership-requests
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $query = PartnershipRequest::with(['sender', 'receiver', 'business']);

        // Admin sees all; others see only their own
        if (!$user->isAdmin()) {
            $query->where(function ($q) use ($user) {
                $q->where('sender_id', $user->id)
                  ->orWhere('receiver_id', $user->id);
            });
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by type
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        $partnerships = $query->orderBy('created_at', 'desc')->paginate(15);

        return response()->json([
            'success' => true,
            'data' => $partnerships,
        ]);
    }

    /**
     * Store a newly created partnership request.
     *
     * POST /api/partnership-requests
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'receiver_id' => ['required', 'exists:users,id'],
            'business_id' => ['nullable', 'exists:businesses,id'],
            'type' => ['required', 'in:funding,energy_support,distribution,product_collaboration,government_program'],
            'message' => ['nullable', 'string'],
        ]);

        $validated['sender_id'] = $request->user()->id;
        $validated['status'] = 'pending';

        $partnership = PartnershipRequest::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Partnership request sent successfully.',
            'data' => $partnership->load(['sender', 'receiver', 'business']),
        ], 201);
    }

    /**
     * Update the status of a partnership request.
     *
     * PUT /api/partnership-requests/{id}/status
     */
    public function updateStatus(Request $request, PartnershipRequest $partnershipRequest): JsonResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:accepted,rejected,completed'],
        ]);

        $partnershipRequest->update(['status' => $validated['status']]);

        return response()->json([
            'success' => true,
            'message' => 'Partnership request status updated.',
            'data' => $partnershipRequest->fresh(['sender', 'receiver', 'business']),
        ]);
    }
}
