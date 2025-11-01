@extends('layouts.app')

@section('title', 'Order Details - Daiyaa Restaurant')

@section('styles')
<style>
    .order-details-container {
        padding: 3rem 0;
    }

    .order-details-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .order-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }

    .details-section {
        background: var(--card-bg);
        border-radius: 15px;
        padding: 2rem;
        border: 1px solid rgba(212, 175, 55, 0.1);
        margin-bottom: 2rem;
    }

    .section-heading {
        color: var(--primary-gold);
        margin-bottom: 1.5rem;
        font-size: 1.3rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(212, 175, 55, 0.1);
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        color: var(--text-secondary);
    }

    .info-value {
        color: var(--text-primary);
        font-weight: 500;
        text-align: right;
    }

    .order-item {
        display: flex;
        justify-content: space-between;
        padding: 1rem 0;
        border-bottom: 1px solid rgba(212, 175, 55, 0.1);
    }

    .order-item:last-child {
        border-bottom: none;
    }

    .item-details {
        flex: 1;
    }

    .item-name {
        color: var(--text-primary);
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .item-meta {
        color: var(--text-secondary);
        font-size: 0.9rem;
    }

    .item-price {
        color: var(--primary-gold);
        font-weight: 600;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        display: inline-block;
    }

    .status-pending {
        background: rgba(255, 193, 7, 0.1);
        color: #ffc107;
        border: 1px solid #ffc107;
    }

    .status-confirmed {
        background: rgba(23, 162, 184, 0.1);
        color: #17a2b8;
        border: 1px solid #17a2b8;
    }

    .status-preparing {
        background: rgba(0, 123, 255, 0.1);
        color: #007bff;
        border: 1px solid #007bff;
    }

    .status-out_for_delivery {
        background: rgba(108, 117, 125, 0.1);
        color: #6c757d;
        border: 1px solid #6c757d;
    }

    .status-delivered {
        background: rgba(40, 167, 69, 0.1);
        color: #28a745;
        border: 1px solid #28a745;
    }

    .status-cancelled {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
        border: 1px solid #dc3545;
    }

    .timeline {
        position: relative;
        padding-left: 2rem;
    }

    .timeline-item {
        position: relative;
        padding-bottom: 2rem;
    }

    .timeline-item:last-child {
        padding-bottom: 0;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: -2rem;
        top: 0;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: var(--primary-gold);
        border: 2px solid var(--dark-bg);
    }

    .timeline-item::after {
        content: '';
        position: absolute;
        left: -1.7rem;
        top: 12px;
        width: 2px;
        height: calc(100% - 12px);
        background: rgba(212, 175, 55, 0.3);
    }

    .timeline-item:last-child::after {
        display: none;
    }

    .timeline-item.inactive::before {
        background: var(--text-secondary);
    }

    .timeline-time {
        color: var(--text-secondary);
        font-size: 0.85rem;
    }

    .timeline-title {
        color: var(--text-primary);
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    @media (max-width: 968px) {
        .order-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .order-details-container {
            padding: 2rem 0;
        }

        .details-section {
            padding: 1.5rem;
        }

        .section-heading {
            font-size: 1.1rem;
        }

        .info-row {
            flex-direction: column;
            gap: 0.5rem;
            align-items: flex-start;
        }

        .info-value {
            text-align: left;
        }

        .order-item {
            flex-direction: column;
            gap: 0.5rem;
            align-items: flex-start;
        }

        .item-meta {
            font-size: 0.85rem;
        }

        .timeline {
            padding-left: 1.5rem;
        }

        .timeline-item::before {
            left: -1.5rem;
        }

        .timeline-item::after {
            left: -1.2rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container order-details-container">
    <div class="order-details-header">
        <h1 class="section-title">Order #{{ $order->order_number }}</h1>
        <p style="color: var(--text-secondary);">Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}</p>
    </div>

    <div class="order-grid">
        <!-- Left Column -->
        <div>
            <!-- Order Items -->
            <div class="details-section">
                <h3 class="section-heading">
                    <i class="bi bi-bag"></i> Order Items
                </h3>
                
                @foreach($order->orderItems as $item)
                    <div class="order-item">
                        <div class="item-details">
                            <div class="item-name">{{ $item->item_name }}</div>
                            <div class="item-meta">
                                Quantity: {{ $item->quantity }} × Rs. {{ number_format($item->item_price, 2) }}
                            </div>
                        </div>
                        <div class="item-price">
                            Rs. {{ number_format($item->subtotal, 2) }}
                        </div>
                    </div>
                @endforeach

                <div class="info-row" style="font-size: 1.2rem; font-weight: 700; color: var(--primary-gold); padding-top: 1.5rem;">
                    <span>Total</span>
                    <span>Rs. {{ number_format($order->total_amount, 2) }}</span>
                </div>
            </div>

            <!-- Delivery Information -->
            <div class="details-section">
                <h3 class="section-heading">
                    <i class="bi bi-truck"></i> Delivery Information
                </h3>
                
                <div class="info-row">
                    <span class="info-label">Customer Name</span>
                    <span class="info-value">{{ $order->customer_name }}</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Phone Number</span>
                    <span class="info-value">{{ $order->customer_phone }}</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Delivery Address</span>
                    <span class="info-value">
                        {{ $order->delivery_address }},<br>
                        {{ $order->delivery_city }}
                        @if($order->delivery_postal_code)
                            {{ $order->delivery_postal_code }}
                        @endif
                    </span>
                </div>
                
                @if($order->order_notes)
                    <div class="info-row">
                        <span class="info-label">Notes</span>
                        <span class="info-value">{{ $order->order_notes }}</span>
                    </div>
                @endif
                
                <div class="info-row">
                    <span class="info-label">Payment Method</span>
                    <span class="info-value">
                        <i class="bi bi-cash"></i> Cash on Delivery
                    </span>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div>
            <!-- Order Status -->
            <div class="details-section">
                <h3 class="section-heading">
                    <i class="bi bi-clock-history"></i> Order Status
                </h3>
                
                <div style="text-align: center; margin-bottom: 2rem;">
                    <span class="status-badge status-{{ $order->status }}">
                        {{ str_replace('_', ' ', $order->status) }}
                    </span>
                </div>

                <div class="timeline">
                    <div class="timeline-item {{ in_array($order->status, ['pending', 'confirmed', 'preparing', 'out_for_delivery', 'delivered']) ? '' : 'inactive' }}">
                        <div class="timeline-title">Order Placed</div>
                        <div class="timeline-time">{{ $order->created_at->format('M d, Y h:i A') }}</div>
                    </div>

                    <div class="timeline-item {{ in_array($order->status, ['confirmed', 'preparing', 'out_for_delivery', 'delivered']) ? '' : 'inactive' }}">
                        <div class="timeline-title">Confirmed</div>
                        @if($order->confirmed_at)
                            <div class="timeline-time">{{ $order->confirmed_at->format('M d, Y h:i A') }}</div>
                        @else
                            <div class="timeline-time">Pending</div>
                        @endif
                    </div>

                    <div class="timeline-item {{ in_array($order->status, ['preparing', 'out_for_delivery', 'delivered']) ? '' : 'inactive' }}">
                        <div class="timeline-title">Preparing</div>
                        <div class="timeline-time">
                            {{ in_array($order->status, ['preparing', 'out_for_delivery', 'delivered']) ? 'In Progress' : 'Pending' }}
                        </div>
                    </div>

                    <div class="timeline-item {{ in_array($order->status, ['out_for_delivery', 'delivered']) ? '' : 'inactive' }}">
                        <div class="timeline-title">Out for Delivery</div>
                        <div class="timeline-time">
                            {{ in_array($order->status, ['out_for_delivery', 'delivered']) ? 'On the way' : 'Pending' }}
                        </div>
                    </div>

                    <div class="timeline-item {{ $order->status === 'delivered' ? '' : 'inactive' }}">
                        <div class="timeline-title">Delivered</div>
                        @if($order->delivered_at)
                            <div class="timeline-time">{{ $order->delivered_at->format('M d, Y h:i A') }}</div>
                        @else
                            <div class="timeline-time">Pending</div>
                        @endif
                    </div>

                    @if($order->status === 'cancelled')
                        <div class="timeline-item">
                            <div class="timeline-title" style="color: var(--danger);">Cancelled</div>
                            <div class="timeline-time">{{ $order->updated_at->format('M d, Y h:i A') }}</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Actions -->
            <div class="details-section">
                <a href="{{ route('orders.index') }}" class="btn btn-outline" style="width: 100%; display: block;">
                    <i class="bi bi-arrow-left"></i> Back to Orders
                </a>
                <a href="{{ route('menu.index') }}" class="btn" style="width: 100%; display: block; margin-top: 1rem;">
                    <i class="bi bi-arrow-repeat"></i> Order Again
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

