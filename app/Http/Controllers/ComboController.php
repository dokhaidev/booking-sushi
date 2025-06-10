<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Combo;
use App\Models\ComboItem;
class ComboController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'status' => 'boolean',
            'items' => 'required|array',
            'items.*.food_id' => 'required|exists:foods,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Create combo
        $combo = Combo::create([
            'name' => $validated['name'],
            'image' => $validated['image'] ?? null,
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'status' => $validated['status'] ?? true,
        ]);

        // Add combo items
        foreach ($validated['items'] as $item) {
            ComboItem::create([
                'combo_id' => $combo->id,
                'food_id' => $item['food_id'],
                'quantity' => $item['quantity'],
            ]);
        }

        return response()->json(['message' => 'Combo created successfully', 'combo' => $combo], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'status' => 'boolean',
            'items' => 'required|array',
            'items.*.food_id' => 'required|exists:foods,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Find combo
        $combo = Combo::findOrFail($id);

        // Update combo
        $combo->update([
            'name' => $validated['name'],
            'image' => $validated['image'] ?? null,
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'],
            'status' => $validated['status'] ?? true,
        ]);

        // Remove old items
        ComboItem::where('combo_id', $combo->id)->delete();

        // Add new items
        foreach ($validated['items'] as $item) {
            ComboItem::create([
                'combo_id' => $combo->id,
                'food_id' => $item['food_id'],
                'quantity' => $item['quantity'],
            ]);
        }

        return response()->json(['message' => 'Combo updated successfully', 'combo' => $combo]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
