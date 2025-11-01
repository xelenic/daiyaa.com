<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::orderBy('sort_order')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.promotions.index', compact('promotions'));
    }

    public function create()
    {
        return view('admin.promotions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_url' => 'nullable|url',
            'is_active' => 'boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_promotion.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('promotions', $filename, 'public');
            $validated['image_url'] = '/storage/' . $path;
        }

        Promotion::create($validated);

        return redirect()->route('admin.promotions.index')
            ->with('success', 'Promotion created successfully!');
    }

    public function edit(Promotion $promotion)
    {
        return view('admin.promotions.edit', compact('promotion'));
    }

    public function update(Request $request, Promotion $promotion)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_url' => 'nullable|url',
            'is_active' => 'boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? $promotion->sort_order;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists and is stored locally
            if ($promotion->image_url && str_starts_with($promotion->image_url, '/storage/')) {
                $oldImagePath = str_replace('/storage/', '', $promotion->image_url);
                Storage::disk('public')->delete($oldImagePath);
            }

            // Store new image
            $image = $request->file('image');
            $filename = time() . '_promotion.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('promotions', $filename, 'public');
            $validated['image_url'] = '/storage/' . $path;
        }

        $promotion->update($validated);

        return redirect()->route('admin.promotions.index')
            ->with('success', 'Promotion updated successfully!');
    }

    public function destroy(Promotion $promotion)
    {
        // Delete image if it exists and is stored locally
        if ($promotion->image_url && str_starts_with($promotion->image_url, '/storage/')) {
            $imagePath = str_replace('/storage/', '', $promotion->image_url);
            Storage::disk('public')->delete($imagePath);
        }

        $promotion->delete();

        return redirect()->route('admin.promotions.index')
            ->with('success', 'Promotion deleted successfully!');
    }
}

