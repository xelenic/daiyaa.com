@extends('layouts.app')

@section('title', 'My Orders - Daiyaa Restaurant')

@section('styles')
<style>
    .orders-container {
        padding: 3rem 0;
        min-height: calc(100vh - 400px);
    }

    .orders-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .order-card {
        background: var(--card-bg);
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
        border: 1px solid rgba(212, 175, 55, 0.1);
        transition: all 0.3s ease;
    }

    .order-card:hover {
        border-color: var(--primary-gold);
        box-shadow: 0 10px 30px rgba(212, 175, 55, 0.2);
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(212, 175, 55, 0.1);
    }

    .order-number {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--primary-gold);
    }

    .order-date {
        color: var(--text-secondary);
        font-size: 0.9rem;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
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

    .order-items {
        margin-bottom: 1rem;
    }

    .order-item-line {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        color: var(--text-secondary);
    }

    .order-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid rgba(212, 175, 55, 0.1);
    }

    .order-total {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--primary-gold);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
    }

    .empty-state i {
        font-size: 5rem;
        color: var(--primary-gold);
        margin-bottom: 1rem;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 2rem;
    }

    .pagination a, .pagination span {
        padding: 0.5rem 1rem;
        background: var(--card-bg);
        color: var(--text-primary);
        border: 1px solid rgba(212, 175, 55, 0.2);
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .pagination a:hover {
        background: var(--primary-gold);
        color: var(--dark-bg);
        border-color: var(--primary-gold);
    }

    .pagination .active {
        background: var(--primary-gold);
        color: var(--dark-bg);
        border-color: var(--primary-gold);
    }

    @media (max-width: 768px) {
        .orders-container {
            padding: 2rem 0;
        }

        .order-card {
            padding: 1.5rem;
        }

        .order-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .order-number {
            font-size: 1rem;
        }

        .order-date {
            font-size: 0.85rem;
        }

        .status-badge {
            font-size: 0.8rem;
            padding: 0.4rem 0.8rem;
        }

        .order-item-line {
            flex-direction: column;
            gap: 0.25rem;
            align-items: flex-start;
        }

        .order-footer {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }

        .order-total {
            font-size: 1.1rem;
        }

        .btn-sm {
            width: 100%;
        }

        .pagination {
            flex-wrap: wrap;
        }

        .pagination a, .pagination span {
            padding: 0.4rem 0.8rem;
            font-size: 0.9rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container orders-container">
    <div class="orders-header">
        <h1 class="section-title">My Orders</h1>
        <p style="color: var(--text-secondary);">Track and view your order history</p>
    </div>

    @if($orders->count() > 0)
        @foreach($orders as $order)
            <div class="order-card">
                <div class="order-header">
                    <div>
                        <div class="order-number">Order #{{ $order->order_number }}</div>
                        <div class="order-date">
                            <i class="bi bi-calendar"></i> {{ $order->created_at->format('M d, Y h:i A') }}
                        </div>
                    </div>
                    <span class="status-badge status-{{ $order->status }}">
                        {{ str_replace('_', ' ', $order->status) }}
                    </span>
                </div>

                <div class="order-items">
                    @foreach($order->orderItems as $item)
                        <div class="order-item-line">
                            <span>{{ $item->item_name }} × {{ $item->quantity }}</span>
                            <span>Rs. {{ number_format($item->subtotal, 2) }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="order-footer">
                    <div class="order-total">
                        Total: Rs. {{ number_format($order->grand_total, 2) }}
                        @if($order->delivery_fee > 0)
                            <small style="color: var(--text-secondary); font-size: 0.85rem;">(incl. Rs. {{ number_format($order->delivery_fee, 2) }} delivery)</small>
                        @endif
                    </div>
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-sm">
                        <i class="bi bi-eye"></i> View Details
                    </a>
                </div>
            </div>
        @endforeach

        <!-- Pagination -->
        @if($orders->hasPages())
            <div class="pagination">
                @if($orders->onFirstPage())
                    <span>&laquo; Previous</span>
                @else
                    <a href="{{ $orders->previousPageUrl() }}">&laquo; Previous</a>
                @endif

                @foreach($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                    @if($page == $orders->currentPage())
                        <span class="active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach

                @if($orders->hasMorePages())
                    <a href="{{ $orders->nextPageUrl() }}">Next &raquo;</a>
                @else
                    <span>Next &raquo;</span>
                @endif
            </div>
        @endif
    @else
        <div class="empty-state">
            <i class="bi bi-bag-x"></i>
            <h2>No orders yet</h2>
            <p style="color: var(--text-secondary); margin-bottom: 2rem;">
                Start ordering from our delicious menu!
            </p>
            <a href="{{ route('menu.index') }}" class="btn">
                <i class="bi bi-arrow-right"></i> Browse Menu
            </a>
        </div>
    @endif
</div>
@endsection

