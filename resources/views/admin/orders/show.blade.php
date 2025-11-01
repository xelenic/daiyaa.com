@extends('layouts.admin')

@section('page-title', 'Order Details')

@section('styles')
<style>
    .admin-order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .admin-order-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .admin-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
    }

    @media (max-width: 968px) {
        .admin-order-grid {
            grid-template-columns: 1fr;
        }

        .admin-info-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .admin-order-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .admin-order-header .btn {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div style="max-width: 1000px;">
    <div class="admin-order-header">
        <div>
            <h2 style="color: var(--primary-gold); margin-bottom: 0.5rem;">Order #{{ $order->order_number }}</h2>
            <p style="color: var(--text-secondary);">{{ $order->created_at->format('F d, Y \a\t h:i A') }}</p>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm" style="background: transparent; color: var(--primary-gold);">
            <i class="bi bi-arrow-left"></i> Back to Orders
        </a>
    </div>

    <div class="admin-order-grid">
        <!-- Order Items -->
        <div class="card">
            <h3 style="color: var(--primary-gold); margin-bottom: 1.5rem;">Order Items</h3>
            
            @foreach($order->orderItems as $item)
                <div style="display: flex; justify-content: space-between; padding: 1rem 0; border-bottom: 1px solid rgba(212, 175, 55, 0.1);">
                    <div>
                        <strong>{{ $item->item_name }}</strong><br>
                        <small style="color: var(--text-secondary);">
                            {{ $item->quantity }} × Rs. {{ number_format($item->item_price, 2) }}
                        </small>
                    </div>
                    <div style="color: var(--primary-gold); font-weight: 600;">
                        Rs. {{ number_format($item->subtotal, 2) }}
                    </div>
                </div>
            @endforeach

            <div style="display: flex; justify-content: space-between; padding-top: 1rem; font-weight: 600; border-top: 1px solid rgba(212, 175, 55, 0.1);">
                <span>Subtotal</span>
                <span>Rs. {{ number_format($order->total_amount, 2) }}</span>
            </div>

            <div style="display: flex; justify-content: space-between; padding: 0.5rem 0;">
                <span>Delivery Fee
                    @if($order->deliveryZone)
                        <small style="color: var(--text-secondary); font-weight: 400;">({{ $order->deliveryZone->name }})</small>
                    @endif
                </span>
                <span style="{{ $order->delivery_fee == 0 ? 'color: var(--success);' : '' }}">
                    @if($order->delivery_fee == 0)
                        FREE
                    @else
                        Rs. {{ number_format($order->delivery_fee, 2) }}
                    @endif
                </span>
            </div>

            <div style="display: flex; justify-content: space-between; padding-top: 1rem; font-size: 1.2rem; font-weight: 700; color: var(--primary-gold); border-top: 2px solid rgba(212, 175, 55, 0.3);">
                <span>Grand Total</span>
                <span>Rs. {{ number_format($order->grand_total, 2) }}</span>
            </div>
        </div>

        <!-- Update Status -->
        <div class="card">
            <h3 style="color: var(--primary-gold); margin-bottom: 1.5rem;">Update Status</h3>
            
            <form method="POST" action="{{ route('admin.orders.update-status', $order) }}">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="status" class="form-label">Order Status</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="preparing" {{ $order->status == 'preparing' ? 'selected' : '' }}>Preparing</option>
                        <option value="out_for_delivery" {{ $order->status == 'out_for_delivery' ? 'selected' : '' }}>Out for Delivery</option>
                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <button type="submit" class="btn" style="width: 100%;">
                    <i class="bi bi-check-circle"></i> Update Status
                </button>
            </form>
        </div>
    </div>

    <!-- Customer & Delivery Info -->
    <div class="admin-info-grid">
        <div class="card">
            <h3 style="color: var(--primary-gold); margin-bottom: 1.5rem;">Customer Information</h3>
            
            <div style="margin-bottom: 1rem;">
                <div style="color: var(--text-secondary); font-size: 0.9rem;">Name</div>
                <div style="font-weight: 600;">{{ $order->customer_name }}</div>
            </div>
            
            <div style="margin-bottom: 1rem;">
                <div style="color: var(--text-secondary); font-size: 0.9rem;">Email</div>
                <div style="font-weight: 600;">{{ $order->user->email }}</div>
            </div>

            <div style="margin-bottom: 1rem;">
                <div style="color: var(--text-secondary); font-size: 0.9rem;">Phone</div>
                <div style="font-weight: 600;">{{ $order->customer_phone }}</div>
            </div>
        </div>

        <div class="card">
            <h3 style="color: var(--primary-gold); margin-bottom: 1.5rem;">Delivery Information</h3>
            
            <div style="margin-bottom: 1rem;">
                <div style="color: var(--text-secondary); font-size: 0.9rem;">Address</div>
                <div style="font-weight: 600;">
                    {{ $order->delivery_address }},<br>
                    {{ $order->delivery_city }}
                    @if($order->delivery_postal_code)
                        {{ $order->delivery_postal_code }}
                    @endif
                </div>
            </div>

            @if($order->order_notes)
                <div style="margin-bottom: 1rem;">
                    <div style="color: var(--text-secondary); font-size: 0.9rem;">Order Notes</div>
                    <div style="font-weight: 600;">{{ $order->order_notes }}</div>
                </div>
            @endif

            <div style="margin-bottom: 1rem;">
                <div style="color: var(--text-secondary); font-size: 0.9rem;">Payment Method</div>
                <div style="font-weight: 600;">
                    <i class="bi bi-cash"></i> Cash on Delivery
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

