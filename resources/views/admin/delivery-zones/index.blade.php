@extends('layouts.admin')

@section('page-title', 'Delivery Zones')

@section('content')
<div style="max-width: 1200px;">
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <div>
                <h2 style="color: var(--primary-gold); margin-bottom: 0.5rem;">
                    <i class="bi bi-geo-alt-fill"></i> Delivery Zones
                </h2>
                <p style="color: var(--text-secondary);">
                    Manage delivery areas and fees
                </p>
            </div>
            <a href="{{ route('admin.delivery-zones.create') }}" class="btn">
                <i class="bi bi-plus-circle"></i> Add New Zone
            </a>
        </div>

        @if(session('success'))
            <div style="background: rgba(40, 167, 69, 0.1); border: 1px solid var(--success); color: var(--success); padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if($zones->isEmpty())
            <div style="text-align: center; padding: 3rem; color: var(--text-secondary);">
                <i class="bi bi-geo-alt" style="font-size: 3rem; opacity: 0.3;"></i>
                <p style="margin-top: 1rem;">No delivery zones found. Create one to get started!</p>
            </div>
        @else
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: 2px solid rgba(212, 175, 55, 0.3);">
                            <th style="padding: 1rem; text-align: left; color: var(--primary-gold);">Zone Name</th>
                            <th style="padding: 1rem; text-align: left; color: var(--primary-gold);">Cities</th>
                            <th style="padding: 1rem; text-align: center; color: var(--primary-gold);">Delivery Fee</th>
                            <th style="padding: 1rem; text-align: center; color: var(--primary-gold);">Min Order</th>
                            <th style="padding: 1rem; text-align: center; color: var(--primary-gold);">Est. Time</th>
                            <th style="padding: 1rem; text-align: center; color: var(--primary-gold);">Status</th>
                            <th style="padding: 1rem; text-align: center; color: var(--primary-gold);">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($zones as $zone)
                            <tr style="border-bottom: 1px solid rgba(212, 175, 55, 0.1);">
                                <td style="padding: 1rem;">
                                    <strong style="color: var(--text-primary);">{{ $zone->name }}</strong>
                                </td>
                                <td style="padding: 1rem;">
                                    <span style="color: var(--text-secondary); font-size: 0.9rem;">
                                        {{ Str::limit($zone->cities, 50) }}
                                    </span>
                                </td>
                                <td style="padding: 1rem; text-align: center;">
                                    <span style="color: var(--primary-gold); font-weight: 600;">
                                        Rs. {{ number_format($zone->delivery_fee, 2) }}
                                    </span>
                                </td>
                                <td style="padding: 1rem; text-align: center;">
                                    <span style="color: var(--text-secondary);">
                                        Rs. {{ number_format($zone->min_order_amount, 2) }}
                                    </span>
                                </td>
                                <td style="padding: 1rem; text-align: center;">
                                    <span style="color: var(--text-secondary);">
                                        {{ $zone->estimated_time }} min
                                    </span>
                                </td>
                                <td style="padding: 1rem; text-align: center;">
                                    @if($zone->is_active)
                                        <span style="background: rgba(40, 167, 69, 0.1); color: var(--success); padding: 0.25rem 0.75rem; border-radius: 15px; font-size: 0.85rem;">
                                            Active
                                        </span>
                                    @else
                                        <span style="background: rgba(220, 53, 69, 0.1); color: var(--danger); padding: 0.25rem 0.75rem; border-radius: 15px; font-size: 0.85rem;">
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td style="padding: 1rem; text-align: center;">
                                    <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                        <a href="{{ route('admin.delivery-zones.edit', $zone) }}" 
                                           class="btn-icon" 
                                           style="background: rgba(23, 162, 184, 0.1); color: var(--info);"
                                           title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.delivery-zones.destroy', $zone) }}" 
                                              method="POST" 
                                              style="display: inline;"
                                              onsubmit="return confirm('Are you sure you want to delete this delivery zone?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn-icon" 
                                                    style="background: rgba(220, 53, 69, 0.1); color: var(--danger);"
                                                    title="Delete">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 2rem;">
                {{ $zones->links() }}
            </div>
        @endif

        <!-- Info Section -->
        <div style="margin-top: 2rem; padding: 1.5rem; background: rgba(23, 162, 184, 0.1); border-radius: 10px; border-left: 4px solid var(--info);">
            <h4 style="color: var(--info); margin-bottom: 1rem;">
                <i class="bi bi-info-circle"></i> How Delivery Zones Work
            </h4>
            <ul style="color: var(--text-secondary); line-height: 1.8; margin: 0;">
                <li>Customers' delivery location is matched with zones based on city or postal code</li>
                <li>If order amount meets minimum order requirement, delivery is FREE</li>
                <li>Otherwise, the zone's delivery fee applies</li>
                <li>Zones are checked in sort order - first match wins</li>
                <li>Inactive zones are not available for delivery</li>
            </ul>
        </div>
    </div>
</div>
@endsection

