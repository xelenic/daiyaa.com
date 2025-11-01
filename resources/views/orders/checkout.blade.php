@extends('layouts.app')

@section('title', 'Checkout - Daiyaa Restaurant')

@section('styles')
<style>
    .checkout-container {
        padding: 3rem 0;
    }

    .checkout-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .checkout-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 2rem;
    }

    .checkout-section {
        background: var(--card-bg);
        border-radius: 15px;
        padding: 2rem;
        border: 1px solid rgba(212, 175, 55, 0.1);
    }

    .section-heading {
        color: var(--primary-gold);
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
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

    .item-name {
        color: var(--text-primary);
        font-weight: 500;
    }

    .item-qty {
        color: var(--text-secondary);
        font-size: 0.9rem;
    }

    .item-price {
        color: var(--primary-gold);
        font-weight: 600;
    }

    .payment-method {
        background: var(--darker-bg);
        border: 2px solid var(--primary-gold);
        border-radius: 10px;
        padding: 1.5rem;
        margin: 1rem 0;
    }

    .payment-icon {
        font-size: 2rem;
        color: var(--primary-gold);
        margin-bottom: 0.5rem;
    }

    @media (max-width: 968px) {
        .checkout-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="container checkout-container">
    <div class="checkout-header">
        <h1 class="section-title">Checkout</h1>
        <p style="color: var(--text-secondary);">Complete your order</p>
    </div>

    <form method="POST" action="{{ route('orders.store') }}">
        @csrf
        
        <div class="checkout-grid">
            <!-- Delivery Information -->
            <div>
                <div class="checkout-section">
                    <h3 class="section-heading">
                        <i class="bi bi-geo-alt"></i> Delivery Information
                    </h3>

                    <div class="form-group">
                        <label for="customer_name" class="form-label">Full Name</label>
                        <input type="text" id="customer_name" name="customer_name" 
                               class="form-control @error('customer_name') is-invalid @enderror"
                               value="{{ old('customer_name', auth()->user()->name) }}" required>
                        @error('customer_name')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="customer_phone" class="form-label">Phone Number</label>
                        <input type="text" id="customer_phone" name="customer_phone" 
                               class="form-control @error('customer_phone') is-invalid @enderror"
                               value="{{ old('customer_phone', auth()->user()->phone) }}" required>
                        @error('customer_phone')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="delivery_address" class="form-label">Delivery Address</label>
                        <textarea id="delivery_address" name="delivery_address" 
                                  class="form-control @error('delivery_address') is-invalid @enderror"
                                  required>{{ old('delivery_address', auth()->user()->address) }}</textarea>
                        @error('delivery_address')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="form-group">
                            <label for="delivery_city" class="form-label">City</label>
                            <input type="text" id="delivery_city" name="delivery_city" 
                                   class="form-control @error('delivery_city') is-invalid @enderror"
                                   value="{{ old('delivery_city', auth()->user()->city) }}" required>
                            @error('delivery_city')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="delivery_postal_code" class="form-label">Postal Code (Optional)</label>
                            <input type="text" id="delivery_postal_code" name="delivery_postal_code" 
                                   class="form-control @error('delivery_postal_code') is-invalid @enderror"
                                   value="{{ old('delivery_postal_code', auth()->user()->postal_code) }}">
                            @error('delivery_postal_code')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="order_notes" class="form-label">Order Notes (Optional)</label>
                        <textarea id="order_notes" name="order_notes" 
                                  class="form-control @error('order_notes') is-invalid @enderror"
                                  placeholder="Any special instructions?">{{ old('order_notes') }}</textarea>
                        @error('order_notes')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="checkout-section" style="margin-top: 2rem;">
                    <h3 class="section-heading">
                        <i class="bi bi-cash"></i> Payment Method
                    </h3>

                    <div class="payment-method">
                        <div class="payment-icon">
                            <i class="bi bi-wallet2"></i>
                        </div>
                        <h4 style="color: var(--text-primary); margin-bottom: 0.5rem;">Cash on Delivery</h4>
                        <p style="color: var(--text-secondary); font-size: 0.9rem;">
                            Pay with cash when your order arrives
                        </p>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div>
                <div class="checkout-section">
                    <h3 class="section-heading">
                        <i class="bi bi-receipt"></i> Order Summary
                    </h3>

                    <div style="margin-bottom: 1.5rem;">
                        @foreach($cartItems as $item)
                            <div class="order-item">
                                <div>
                                    <div class="item-name">{{ $item->menuItem->name }}</div>
                                    <div class="item-qty">Qty: {{ $item->quantity }}</div>
                                </div>
                                <div class="item-price">
                                    Rs. {{ number_format($item->quantity * $item->menuItem->price, 2) }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="order-item" style="font-weight: 600;">
                        <span>Subtotal</span>
                        <span>Rs. {{ number_format($total, 2) }}</span>
                    </div>

                    <div class="order-item" style="color: var(--success);">
                        <span>Delivery Fee</span>
                        <span>FREE</span>
                    </div>

                    <div class="order-item" style="font-size: 1.3rem; color: var(--primary-gold); font-weight: 700; padding-top: 1.5rem;">
                        <span>Total</span>
                        <span>Rs. {{ number_format($total, 2) }}</span>
                    </div>

                    <button type="submit" class="btn" style="width: 100%; margin-top: 2rem;">
                        <i class="bi bi-check-circle"></i> Place Order
                    </button>

                    <a href="{{ route('cart.index') }}" class="btn btn-outline" style="width: 100%; margin-top: 1rem; display: block;">
                        <i class="bi bi-arrow-left"></i> Back to Cart
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

