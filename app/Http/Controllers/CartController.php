<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Auth::user()->cartItems()->with('menuItem')->get();
        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->menuItem->price;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, MenuItem $menuItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        // Check if item already exists in cart
        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('menu_item_id', $menuItem->id)
            ->first();

        if ($cartItem) {
            // Update existing cart item
            $cartItem->update([
                'quantity' => $cartItem->quantity + $request->quantity,
            ]);
        } else {
            // Create new cart item
            $cartItem = CartItem::create([
                'user_id' => Auth::id(),
                'menu_item_id' => $menuItem->id,
                'quantity' => $request->quantity,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Item added to cart!',
            'cart_count' => Auth::user()->cart_count,
        ]);
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $this->authorize('update', $cartItem);

        $request->validate([
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        $cartItem->update([
            'quantity' => $request->quantity,
        ]);

        $total = Auth::user()->cartItems()->with('menuItem')->get()->sum(function ($item) {
            return $item->quantity * $item->menuItem->price;
        });

        return response()->json([
            'success' => true,
            'message' => 'Cart updated!',
            'subtotal' => number_format($cartItem->quantity * $cartItem->menuItem->price, 2),
            'total' => number_format($total, 2),
        ]);
    }

    public function destroy(CartItem $cartItem)
    {
        $this->authorize('delete', $cartItem);

        $cartItem->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart!',
            'cart_count' => Auth::user()->cart_count,
        ]);
    }

    public function clear()
    {
        Auth::user()->cartItems()->delete();

        return redirect()->route('cart.index')->with('success', 'Cart cleared!');
    }
}

