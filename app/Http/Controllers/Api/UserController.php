<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * FR-USER-001 List users (Admin only)
     */
    public function index(Request $request): JsonResponse
    {
        $query = User::with('roles');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->has('role')) {
            $query->role($request->role);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $sortBy = $request->get('sort_by', 'created_at');
        $sortDir = $request->get('sort_dir', 'desc');
        $query->orderBy($sortBy, $sortDir);

        $users = $query->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'message' => 'Data user berhasil diambil',
            'data' => $users,
        ]);
    }

    /**
     * Show single user
     */
    public function show(User $user): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail user berhasil diambil',
            'data' => $user->load('roles'),
        ]);
    }

    /**
     * FR-USER-002 Update user status
     */
    public function updateStatus(Request $request, User $user): JsonResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:active,pending,suspended',
        ]);

        $user->update(['status' => $validated['status']]);

        return response()->json([
            'success' => true,
            'message' => 'Status user berhasil diubah',
            'data' => $user->load('roles'),
        ]);
    }

    /**
     * FR-USER-003 Delete user
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User berhasil dihapus',
        ]);
    }

    /**
     * FR-USER-004 Update user role
     */
    public function updateRole(Request $request, User $user): JsonResponse
    {
        $validated = $request->validate([
            'role' => 'required|in:admin,umkm,government,provider,partner',
        ]);

        $user->syncRoles([$validated['role']]);

        return response()->json([
            'success' => true,
            'message' => 'Role user berhasil diubah',
            'data' => $user->load('roles'),
        ]);
    }
}
