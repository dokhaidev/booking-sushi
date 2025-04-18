<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Constraint\Count;

class MenuController extends Controller
{
    // Lấy danh sách menu
    public function index()
    {
        $menus = Menu::all();
        return response()->json($menus);
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

        $menu = Menu::create($validated);

        return response()->json([
            'message' => 'Menu created successfully.',
            'data' => $menu
        ], 201);
    }

    // Lấy chi tiết món
    public function show($id)
    {
        $menu = Menu::with('category')->find($id);

        if (!$menu) {
            return response()->json(['message' => 'Menu not found.'], 404);
        }

        return response()->json($menu);
    }

    // Cập nhật món
    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return response()->json(['message' => 'Menu not found.'], 404);
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
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            $validated['image'] = $request->file('image')->store('uploads', 'public');
        }

        $menu->update($validated);

        return response()->json([
            'message' => 'Menu updated successfully.',
            'data' => $menu
        ]);
    }

    // Xoá món
    public function destroy($id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return response()->json(['message' => 'Menu not found.'], 404);
        }

        if ($menu->image) {
            Storage::disk('public')->delete($menu->image);
        }

        $menu->delete();

        return response()->json(['message' => 'Menu deleted successfully.']);
    }
    // tỏng món ăn
    public function stats(){
        $stats = Menu::count();
        return response() -> json($stats);
    }
}
