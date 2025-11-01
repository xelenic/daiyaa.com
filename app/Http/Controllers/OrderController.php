<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\DeliveryZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);

        $order->load('orderItems.menuItem');

        return view('orders.show', compact('order'));
    }

    public function checkout()
    {
        $cartItems = Auth::user()->cartItems()->with('menuItem')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->quantity * $item->menuItem->price;
        });

        return view('orders.checkout', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'delivery_address' => 'required|string|max:500',
            'delivery_city' => 'required|string|max:100',
            'delivery_postal_code' => 'nullable|string|max:10',
            'order_notes' => 'nullable|string|max:1000',
        ]);

        $cartItems = Auth::user()->cartItems()->with('menuItem')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        DB::beginTransaction();

        try {
            $total = $cartItems->sum(function ($item) {
                return $item->quantity * $item->menuItem->price;
            });

            // Find delivery zone and calculate delivery fee
            $deliveryZone = DeliveryZone::findForLocation(
                $validated['delivery_city'],
                $validated['delivery_postal_code'] ?? null
            );

            if (!$deliveryZone) {
                return redirect()->route('orders.checkout')
                    ->with('error', 'Sorry, we do not deliver to your location at this time. Please contact us for more information.');
            }

            $deliveryFee = $deliveryZone->calculateFee($total);

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => Order::generateOrderNumber(),
                'total_amount' => $total,
                'delivery_fee' => $deliveryFee,
                'delivery_zone_id' => $deliveryZone->id,
                'status' => 'pending',
                'payment_method' => 'cash_on_delivery',
                'customer_name' => $validated['customer_name'],
                'customer_phone' => $validated['customer_phone'],
                'delivery_address' => $validated['delivery_address'],
                'delivery_city' => $validated['delivery_city'],
                'delivery_postal_code' => $validated['delivery_postal_code'] ?? null,
                'order_notes' => $validated['order_notes'] ?? null,
            ]);

            // Create order items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $cartItem->menu_item_id,
                    'item_name' => $cartItem->menuItem->name,
                    'item_price' => $cartItem->menuItem->price,
                    'quantity' => $cartItem->quantity,
                    'subtotal' => $cartItem->quantity * $cartItem->menuItem->price,
                ]);
            }

            // Clear cart
            Auth::user()->cartItems()->delete();

            DB::commit();

            return redirect()->route('orders.show', $order)
                ->with('success', 'Order placed successfully! Order #' . $order->order_number);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.index')
                ->with('error', 'Failed to place order. Please try again.');
        }
    }
}

