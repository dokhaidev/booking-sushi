<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Constraint\Count;

class FoodController extends Controller
{
    // Lấy danh sách Food
    public function index()
    {
        $Foods = Food::all();
        return response()->json($Foods);
    }

    // Tạo món mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'tag' => 'required|in:hot,new',
            'status' => 'required|in:available,unavailable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            "tag" => "required"
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('uploads', 'public');
        }

        $Food = Food::create($validated);

        return response()->json([
            'message' => 'Food created successfully.',
            'data' => $Food
        ], 201);
    }

    // Lấy chi tiết món
    public function show($id)
    {
        $Food = Food::with('category')->find($id);

        if (!$Food) {
            return response()->json(['message' => 'Food not found.'], 404);
        }

        return response()->json($Food);
    }

    // Cập nhật món
    public function update(Request $request, $id)
    {
        $Food = Food::find($id);

        if (!$Food) {
            return response()->json(['message' => 'Food not found.'], 404);
        }

        $validated = $request->validate([
            'category_id' => 'sometimes|exists:categories,id',
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|numeric|min:0',
            'tag' => 'sometimes|in:hot,new',
            'status' => 'sometimes|in:available,unavailable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($Food->image) {
                Storage::disk('public')->delete($Food->image);
            }
            $validated['image'] = $request->file('image')->store('uploads', 'public');
        }

        $Food->update($validated);

        return response()->json([
            'message' => 'Food updated successfully.',
            'data' => $Food
        ]);
    }

    // Xoá món
    public function destroy($id)
    {
        $Food = Food::find($id);

        if (!$Food) {
            return response()->json(['message' => 'Food not found.'], 404);
        }

        if ($Food->image) {
            Storage::disk('public')->delete($Food->image);
        }

        $Food->delete();

        return response()->json(['message' => 'Food deleted successfully.']);
    }
    // tỏng món ăn
    public function stats(){
        $stats = Food::count();
        return response() -> json($stats);
    }
}
