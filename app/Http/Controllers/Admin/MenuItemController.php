<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MenuItemController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::with('category')
            ->orderBy('sort_order')
            ->paginate(20);

        return view('admin.menu-items.index', compact('menuItems'));
    }

    public function create()
    {
        $categories = Category::orderBy('sort_order')->get();
        return view('admin.menu-items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_url' => 'nullable|url',
            'is_available' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_available'] = $request->has('is_available');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($validated['name']) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('menu-items', $filename, 'public');
            $validated['image_url'] = '/storage/' . $path;
        }

        MenuItem::create($validated);

        return redirect()->route('admin.menu-items.index')
            ->with('success', 'Menu item created successfully!');
    }

    public function edit(MenuItem $menuItem)
    {
        $categories = Category::orderBy('sort_order')->get();
        return view('admin.menu-items.edit', compact('menuItem', 'categories'));
    }

    public function update(Request $request, MenuItem $menuItem)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_url' => 'nullable|url',
            'is_available' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_available'] = $request->has('is_available');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? $menuItem->sort_order;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists and is stored locally
            if ($menuItem->image_url && str_starts_with($menuItem->image_url, '/storage/')) {
                $oldImagePath = str_replace('/storage/', '', $menuItem->image_url);
                Storage::disk('public')->delete($oldImagePath);
            }

            // Store new image
            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($validated['name']) . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('menu-items', $filename, 'public');
            $validated['image_url'] = '/storage/' . $path;
        }

        $menuItem->update($validated);

        return redirect()->route('admin.menu-items.index')
            ->with('success', 'Menu item updated successfully!');
    }

    public function destroy(MenuItem $menuItem)
    {
        // Delete image if it exists and is stored locally
        if ($menuItem->image_url && str_starts_with($menuItem->image_url, '/storage/')) {
            $imagePath = str_replace('/storage/', '', $menuItem->image_url);
            Storage::disk('public')->delete($imagePath);
        }

        $menuItem->delete();

        return redirect()->route('admin.menu-items.index')
            ->with('success', 'Menu item deleted successfully!');
    }
}

