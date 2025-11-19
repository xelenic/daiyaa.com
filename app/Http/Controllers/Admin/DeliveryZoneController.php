<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryZone;
use Illuminate\Http\Request;

class DeliveryZoneController extends Controller
{
    public function index()
    {
        $zones = DeliveryZone::orderBy('sort_order')->paginate(20);
        return view('admin.delivery-zones.index', compact('zones'));
    }

    public function create()
    {
        return view('admin.delivery-zones.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cities' => 'nullable|string',
            'postal_codes' => 'nullable|string',
            'delivery_fee' => 'required|numeric|min:0',
            'min_order_amount' => 'required|integer|min:0',
            'estimated_time' => 'required|integer|min:1',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active');

        DeliveryZone::create($validated);

        return redirect()->route('admin.delivery-zones.index')
            ->with('success', 'Delivery zone created successfully!');
    }

    public function edit(DeliveryZone $deliveryZone)
    {
        return view('admin.delivery-zones.edit', compact('deliveryZone'));
    }

    public function update(Request $request, DeliveryZone $deliveryZone)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cities' => 'nullable|string',
            'postal_codes' => 'nullable|string',
            'delivery_fee' => 'required|numeric|min:0',
            'min_order_amount' => 'required|integer|min:0',
            'estimated_time' => 'required|integer|min:1',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $deliveryZone->update($validated);

        return redirect()->route('admin.delivery-zones.index')
            ->with('success', 'Delivery zone updated successfully!');
    }

    public function destroy(DeliveryZone $deliveryZone)
    {
        $deliveryZone->delete();

        return redirect()->route('admin.delivery-zones.index')
            ->with('success', 'Delivery zone deleted successfully!');
    }

    /**
     * AJAX endpoint to get delivery fee for a location
     */
    public function calculateFee(Request $request)
    {
        $request->validate([
            'city' => 'required|string',
            'postal_code' => 'nullable|string',
            'order_amount' => 'required|numeric|min:0',
        ]);

        $zone = DeliveryZone::findForLocation(
            $request->city,
            $request->postal_code
        );

        if (!$zone) {
            return response()->json([
                'success' => false,
                'message' => 'Delivery not available in your area. Please contact us.',
            ]);
        }

        $deliveryFee = $zone->calculateFee($request->order_amount);

        return response()->json([
            'success' => true,
            'zone_id' => $zone->id,
            'zone_name' => $zone->name,
            'delivery_fee' => $deliveryFee,
            'estimated_time' => $zone->estimated_time,
            'min_order_amount' => $zone->min_order_amount,
            'is_free_delivery' => $deliveryFee == 0,
        ]);
    }
}


