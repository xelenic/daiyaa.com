@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('styles')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--card-bg);
        border-radius: 15px;
        padding: 2rem;
        border: 1px solid rgba(212, 175, 55, 0.1);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        border-color: var(--primary-gold);
        box-shadow: 0 10px 30px rgba(212, 175, 55, 0.2);
        transform: translateY(-5px);
    }

    .stat-icon {
        font-size: 2.5rem;
        color: var(--primary-gold);
        margin-bottom: 1rem;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: var(--text-secondary);
        font-size: 0.9rem;
    }
</style>
@endsection

@section('content')
<h2 style="color: var(--primary-gold); margin-bottom: 2rem;">Overview</h2>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon"><i class="bi bi-receipt"></i></div>
        <div class="stat-value">{{ $stats['total_orders'] }}</div>
        <div class="stat-label">Total Orders</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon"><i class="bi bi-clock"></i></div>
        <div class="stat-value">{{ $stats['pending_orders'] }}</div>
        <div class="stat-label">Pending Orders</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon"><i class="bi bi-currency-dollar"></i></div>
        <div class="stat-value">Rs. {{ number_format($stats['total_revenue'], 2) }}</div>
        <div class="stat-label">Total Revenue</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon"><i class="bi bi-people"></i></div>
        <div class="stat-value">{{ $stats['total_customers'] }}</div>
        <div class="stat-label">Total Customers</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon"><i class="bi bi-card-list"></i></div>
        <div class="stat-value">{{ $stats['total_menu_items'] }}</div>
        <div class="stat-label">Menu Items</div>
    </div>
</div>

<h2 style="color: var(--primary-gold); margin: 3rem 0 2rem;">Recent Orders</h2>

<div class="card">
    <table class="table">
        <thead>
            <tr>
                <th>Order #</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Total</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentOrders as $order)
                <tr>
                    <td style="font-weight: 600; color: var(--primary-gold);">{{ $order->order_number }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->created_at->format('M d, Y h:i A') }}</td>
                    <td>Rs. {{ number_format($order->total_amount, 2) }}</td>
                    <td>
                        <span style="text-transform: capitalize;">{{ str_replace('_', ' ', $order->status) }}</span>
                    </td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: var(--text-secondary); padding: 2rem;">
                        No orders yet
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

