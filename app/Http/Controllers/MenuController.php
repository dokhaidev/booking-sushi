<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    // Danh sách menu
    public function index()
    {
        return response()->json(Menu::all());
    }

    // Tạo món mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:available,unavailable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('menus', 'public');
        }

        $menu = Menu::create($validated);
        return response()->json(['message' => 'Menu created', 'data' => $menu], 201);
    }

    // Chi tiết món
    public function show($id)
    {
        return response()->json(Menu::with('category')->findOrFail($id));
    }

    // Cập nhật món
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $validated = $request->validate([
            'category_id' => 'sometimes|exists:categories,id',
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|numeric|min:0',
            'status' => 'in:available,unavailable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            $validated['image'] = $request->file('image')->store('menus', 'public');
        }

        $menu->update($validated);
        return response()->json(['message' => 'Menu updated', 'data' => $menu]);
    }
    // Xoá món
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        if ($menu->image) {
            Storage::disk('public')->delete($menu->image);
        }

        $menu->delete();
        return response()->json(['message' => 'Menu deleted']);
    }
}
