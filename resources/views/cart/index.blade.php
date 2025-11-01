@extends('layouts.app')

@section('title', 'Shopping Cart - Daiyaa Restaurant')

@section('styles')
<style>
    .cart-container {
        padding: 3rem 0;
    }

    .cart-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .cart-items {
        background: var(--card-bg);
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .cart-item {
        display: grid;
        grid-template-columns: 100px 1fr auto;
        gap: 1.5rem;
        padding: 1.5rem 0;
        border-bottom: 1px solid rgba(212, 175, 55, 0.1);
        align-items: center;
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .cart-item-image {
        width: 100px;
        height: 100px;
        border-radius: 10px;
        object-fit: cover;
    }

    .cart-item-details h3 {
        color: var(--text-primary);
        margin-bottom: 0.5rem;
        font-size: 1.2rem;
    }

    .cart-item-price {
        color: var(--primary-gold);
        font-weight: 600;
        font-size: 1.1rem;
    }

    .cart-item-controls {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        align-items: flex-end;
    }

    .quantity-control {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .qty-btn {
        background: var(--darker-bg);
        border: 1px solid var(--primary-gold);
        color: var(--primary-gold);
        width: 30px;
        height: 30px;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .qty-btn:hover {
        background: var(--primary-gold);
        color: var(--dark-bg);
    }

    .qty-display {
        min-width: 40px;
        text-align: center;
        font-weight: 600;
        color: var(--text-primary);
    }

    .item-subtotal {
        color: var(--text-primary);
        font-weight: 600;
    }

    .remove-btn {
        background: none;
        border: none;
        color: var(--danger);
        cursor: pointer;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .remove-btn:hover {
        color: var(--text-primary);
    }

    .cart-summary {
        background: var(--card-bg);
        border-radius: 15px;
        padding: 2rem;
        border: 1px solid rgba(212, 175, 55, 0.2);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 1rem 0;
        border-bottom: 1px solid rgba(212, 175, 55, 0.1);
    }

    .summary-row:last-child {
        border-bottom: none;
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--primary-gold);
    }

    .cart-actions {
        display: grid;
        gap: 1rem;
        margin-top: 2rem;
    }

    .empty-cart {
        text-align: center;
        padding: 4rem 2rem;
    }

    .empty-cart i {
        font-size: 5rem;
        color: var(--primary-gold);
        margin-bottom: 1rem;
    }

    .empty-cart h2 {
        color: var(--text-primary);
        margin-bottom: 1rem;
    }

    .empty-cart p {
        color: var(--text-secondary);
        margin-bottom: 2rem;
    }

    .cart-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }

    @media (max-width: 968px) {
        .cart-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .cart-container {
            padding: 2rem 0;
        }

        .cart-items {
            padding: 1.5rem;
        }

        .cart-item {
            grid-template-columns: 80px 1fr;
            gap: 1rem;
        }

        .cart-item-image {
            width: 80px;
            height: 80px;
        }

        .cart-item-details h3 {
            font-size: 1rem;
        }

        .cart-item-controls {
            grid-column: 1 / -1;
            flex-direction: row;
            justify-content: space-between;
            width: 100%;
        }

        .cart-summary {
            padding: 1.5rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container cart-container">
    <div class="cart-header">
        <h1 class="section-title">Shopping Cart</h1>
    </div>

    @if($cartItems->count() > 0)
        <div class="cart-grid">
            <div>
                <div class="cart-items">
                    @foreach($cartItems as $item)
                        <div class="cart-item" data-cart-id="{{ $item->id }}">
                            <img src="{{ $item->menuItem->image_url }}" alt="{{ $item->menuItem->name }}" class="cart-item-image">
                            
                            <div class="cart-item-details">
                                <h3>{{ $item->menuItem->name }}</h3>
                                <p class="cart-item-price">Rs. {{ number_format($item->menuItem->price, 2) }}</p>
                            </div>

                            <div class="cart-item-controls">
                                <div class="quantity-control">
                                    <button class="qty-btn qty-minus" data-cart-id="{{ $item->id }}">-</button>
                                    <span class="qty-display">{{ $item->quantity }}</span>
                                    <button class="qty-btn qty-plus" data-cart-id="{{ $item->id }}">+</button>
                                </div>
                                <div class="item-subtotal" data-subtotal="{{ $item->quantity * $item->menuItem->price }}">
                                    Rs. {{ number_format($item->quantity * $item->menuItem->price, 2) }}
                                </div>
                                <button class="remove-btn" data-cart-id="{{ $item->id }}">
                                    <i class="bi bi-trash"></i> Remove
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div>
                <div class="cart-summary">
                    <h3 style="margin-bottom: 1rem; color: var(--primary-gold);">Order Summary</h3>
                    
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span id="cart-total">Rs. {{ number_format($total, 2) }}</span>
                    </div>
                    
                    <div class="summary-row">
                        <span>Delivery</span>
                        <span style="color: var(--success);">FREE</span>
                    </div>

                    <div class="summary-row">
                        <span>Total</span>
                        <span id="cart-final-total">Rs. {{ number_format($total, 2) }}</span>
                    </div>

                    <div class="cart-actions">
                        <a href="{{ route('checkout') }}" class="btn">
                            <i class="bi bi-credit-card"></i> Proceed to Checkout
                        </a>
                        <a href="{{ route('menu.index') }}" class="btn btn-outline">
                            <i class="bi bi-arrow-left"></i> Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="empty-cart">
            <i class="bi bi-cart-x"></i>
            <h2>Your cart is empty</h2>
            <p>Add some delicious items from our menu!</p>
            <a href="{{ route('menu.index') }}" class="btn">
                <i class="bi bi-arrow-left"></i> Browse Menu
            </a>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    // Update quantity
    async function updateQuantity(cartId, newQty) {
        try {
            const response = await fetch(`/cart/${cartId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ quantity: newQty })
            });

            const data = await response.json();
            
            if (data.success) {
                // Update item subtotal
                const cartItem = document.querySelector(`[data-cart-id="${cartId}"]`);
                const subtotalEl = cartItem.querySelector('.item-subtotal');
                subtotalEl.textContent = `Rs. ${data.subtotal}`;

                // Update cart totals
                document.getElementById('cart-total').textContent = `Rs. ${data.total}`;
                document.getElementById('cart-final-total').textContent = `Rs. ${data.total}`;
            }
        } catch (error) {
            console.error('Error updating quantity:', error);
        }
    }

    // Quantity buttons
    document.querySelectorAll('.qty-minus').forEach(btn => {
        btn.addEventListener('click', function() {
            const cartId = this.dataset.cartId;
            const qtyDisplay = this.parentElement.querySelector('.qty-display');
            const currentQty = parseInt(qtyDisplay.textContent);
            
            if (currentQty > 1) {
                const newQty = currentQty - 1;
                qtyDisplay.textContent = newQty;
                updateQuantity(cartId, newQty);
            }
        });
    });

    document.querySelectorAll('.qty-plus').forEach(btn => {
        btn.addEventListener('click', function() {
            const cartId = this.dataset.cartId;
            const qtyDisplay = this.parentElement.querySelector('.qty-display');
            const currentQty = parseInt(qtyDisplay.textContent);
            
            if (currentQty < 99) {
                const newQty = currentQty + 1;
                qtyDisplay.textContent = newQty;
                updateQuantity(cartId, newQty);
            }
        });
    });

    // Remove item
    document.querySelectorAll('.remove-btn').forEach(btn => {
        btn.addEventListener('click', async function() {
            if (!confirm('Remove this item from cart?')) return;
            
            const cartId = this.dataset.cartId;
            
            try {
                const response = await fetch(`/cart/${cartId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();
                
                if (data.success) {
                    // Remove item from DOM
                    const cartItem = document.querySelector(`.cart-item[data-cart-id="${cartId}"]`);
                    cartItem.remove();

                    // Update cart badge
                    const cartBadge = document.querySelector('.cart-badge .badge');
                    if (cartBadge) {
                        if (data.cart_count > 0) {
                            cartBadge.textContent = data.cart_count;
                        } else {
                            cartBadge.remove();
                        }
                    }

                    // Reload if cart is empty
                    if (data.cart_count === 0) {
                        window.location.reload();
                    } else {
                        // Recalculate total
                        let total = 0;
                        document.querySelectorAll('.item-subtotal').forEach(el => {
                            const subtotalText = el.textContent.replace('Rs. ', '').replace(',', '');
                            total += parseFloat(subtotalText);
                        });
                        document.getElementById('cart-total').textContent = `Rs. ${total.toFixed(2)}`;
                        document.getElementById('cart-final-total').textContent = `Rs. ${total.toFixed(2)}`;
                    }
                }
            } catch (error) {
                console.error('Error removing item:', error);
                alert('Failed to remove item. Please try again.');
            }
        });
    });
</script>
@endsection

