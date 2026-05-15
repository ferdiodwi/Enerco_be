<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PartnershipRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PartnershipController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $q = PartnershipRequest::with(['sender', 'receiver', 'business']);
        if ($request->has('status')) $q->where('status', $request->status);

        $user = $request->user();
        if (!$user->hasRole('admin')) {
            $q->where(fn($query) => $query->where('sender_id', $user->id)->orWhere('receiver_id', $user->id));
        }

        $data = $q->orderBy('created_at', 'desc')->paginate($request->get('per_page', 15));
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function store(Request $request): JsonResponse
    {
        $v = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'business_id' => 'nullable|exists:businesses,id',
            'type' => 'required|string|max:100',
            'title' => 'required|string|max:150',
            'message' => 'required|string',
            'attachment' => 'nullable|file|max:5120',
        ]);

        $v['sender_id'] = $request->user()->id;
        $v['status'] = 'pending';
        if ($request->hasFile('attachment')) $v['attachment'] = $request->file('attachment')->store('partnerships', 'public');

        $p = PartnershipRequest::create($v);
        return response()->json(['success' => true, 'data' => $p->load(['sender', 'receiver'])], 201);
    }

    public function show(PartnershipRequest $partnership): JsonResponse
    {
        return response()->json(['success' => true, 'data' => $partnership->load(['sender', 'receiver', 'business'])]);
    }

    public function updateStatus(Request $request, PartnershipRequest $partnership): JsonResponse
    {
        $v = $request->validate(['status' => 'required|in:pending,accepted,rejected,in_progress,completed']);
        $partnership->update($v);
        return response()->json(['success' => true, 'data' => $partnership]);
    }
}
