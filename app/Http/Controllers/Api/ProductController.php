<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Product::with('business:id,name,sector');

        if ($request->has('category')) $query->where('category', $request->category);
        if ($request->has('status')) $query->where('status', $request->status);
        if ($request->has('search')) $query->where('name', 'like', "%{$request->search}%");
        if ($request->has('clean_energy')) $query->where('is_clean_energy_powered', true);

        $products = $query->orderBy('created_at', 'desc')->paginate($request->get('per_page', 15));

        return response()->json(['success' => true, 'data' => $products]);
    }

    public function store(Request $request): JsonResponse
    {
        $v = $request->validate([
            'business_id' => 'required|exists:businesses,id',
            'name' => 'required|string|max:150',
            'description' => 'required|string',
            'category' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'is_clean_energy_powered' => 'required|boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        $v['status'] = 'pending';
        if ($request->hasFile('image')) $v['image'] = $request->file('image')->store('products', 'public');

        $product = Product::create($v);
        return response()->json(['success' => true, 'message' => 'Produk berhasil ditambahkan', 'data' => $product], 201);
    }

    public function show(Product $product): JsonResponse
    {
        return response()->json(['success' => true, 'data' => $product->load('business')]);
    }

    public function update(Request $request, Product $product): JsonResponse
    {
        $v = $request->validate([
            'name' => 'sometimes|string|max:150', 'description' => 'sometimes|string',
            'category' => 'sometimes|string|max:100', 'price' => 'sometimes|numeric|min:0',
            'stock' => 'sometimes|integer|min:0', 'is_clean_energy_powered' => 'sometimes|boolean',
            'image' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('image')) $v['image'] = $request->file('image')->store('products', 'public');
        $product->update($v);
        return response()->json(['success' => true, 'data' => $product]);
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();
        return response()->json(['success' => true, 'message' => 'Produk berhasil dihapus']);
    }

    public function updateStatus(Request $request, Product $product): JsonResponse
    {
        $v = $request->validate(['status' => 'required|in:pending,active,rejected,archived']);
        $product->update($v);
        return response()->json(['success' => true, 'data' => $product]);
    }
}
