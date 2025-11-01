<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->withCount('menuItems')
            ->get();

        $query = MenuItem::with('category')
            ->where('is_available', true);

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Search
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $menuItems = $query->orderBy('sort_order')->get();

        return view('menu.index', compact('categories', 'menuItems'));
    }

    public function show($slug)
    {
        $menuItem = MenuItem::where('slug', $slug)
            ->with('category')
            ->firstOrFail();

        return view('menu.show', compact('menuItem'));
    }
}

