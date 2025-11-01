@extends('layouts.admin')

@section('page-title', 'Orders')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h2 style="color: var(--primary-gold);">Orders</h2>
</div>

<div style="margin-bottom: 2rem;">
    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
        <a href="{{ route('admin.orders.index') }}" 
           class="btn btn-sm {{ !request('status') ? '' : 'btn-outline' }}">
            All Orders
        </a>
        <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" 
           class="btn btn-sm {{ request('status') == 'pending' ? '' : 'btn-outline' }}"
           style="{{ request('status') != 'pending' ? 'background: transparent; color: var(--primary-gold);' : '' }}">
            Pending
        </a>
        <a href="{{ route('admin.orders.index', ['status' => 'confirmed']) }}" 
           class="btn btn-sm {{ request('status') == 'confirmed' ? '' : 'btn-outline' }}"
           style="{{ request('status') != 'confirmed' ? 'background: transparent; color: var(--primary-gold);' : '' }}">
            Confirmed
        </a>
        <a href="{{ route('admin.orders.index', ['status' => 'preparing']) }}" 
           class="btn btn-sm {{ request('status') == 'preparing' ? '' : 'btn-outline' }}"
           style="{{ request('status') != 'preparing' ? 'background: transparent; color: var(--primary-gold);' : '' }}">
            Preparing
        </a>
        <a href="{{ route('admin.orders.index', ['status' => 'out_for_delivery']) }}" 
           class="btn btn-sm {{ request('status') == 'out_for_delivery' ? '' : 'btn-outline' }}"
           style="{{ request('status') != 'out_for_delivery' ? 'background: transparent; color: var(--primary-gold);' : '' }}">
            Out for Delivery
        </a>
        <a href="{{ route('admin.orders.index', ['status' => 'delivered']) }}" 
           class="btn btn-sm {{ request('status') == 'delivered' ? '' : 'btn-outline' }}"
           style="{{ request('status') != 'delivered' ? 'background: transparent; color: var(--primary-gold);' : '' }}">
            Delivered
        </a>
    </div>
</div>

<div class="card">
    <table class="table">
        <thead>
            <tr>
                <th>Order #</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Items</th>
                <th>Total</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td style="font-weight: 600; color: var(--primary-gold);">{{ $order->order_number }}</td>
                    <td>
                        <strong>{{ $order->user->name }}</strong><br>
                        <small style="color: var(--text-secondary);">{{ $order->customer_phone }}</small>
                    </td>
                    <td>{{ $order->created_at->format('M d, Y h:i A') }}</td>
                    <td>{{ $order->orderItems->count() }} items</td>
                    <td style="color: var(--primary-gold); font-weight: 600;">Rs. {{ number_format($order->total_amount, 2) }}</td>
                    <td>
                        <span style="text-transform: capitalize;">{{ str_replace('_', ' ', $order->status) }}</span>
                    </td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; color: var(--text-secondary); padding: 2rem;">
                        No orders found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($orders->hasPages())
        <div style="padding: 1rem; border-top: 1px solid rgba(212, 175, 55, 0.1);">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection

