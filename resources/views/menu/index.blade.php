@extends('layouts.app')

@section('title', 'Menu - Daiyaa Restaurant')

@section('styles')
<style>
    .menu-header {
        text-align: center;
        padding: 3rem 0 2rem;
    }

    .menu-subtitle {
        color: var(--text-secondary);
        margin-bottom: 2rem;
    }

    .filters {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 3rem;
        flex-wrap: wrap;
    }

    .filter-btn {
        padding: 0.5rem 1.5rem;
        background: var(--card-bg);
        color: var(--text-primary);
        border: 1px solid rgba(212, 175, 55, 0.2);
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .filter-btn:hover, .filter-btn.active {
        background: var(--primary-gold);
        color: var(--dark-bg);
        border-color: var(--primary-gold);
    }

    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .menu-card {
        background: var(--card-bg);
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        border: 1px solid rgba(212, 175, 55, 0.1);
    }

    .menu-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(212, 175, 55, 0.2);
        border-color: var(--primary-gold);
    }

    .menu-card img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .menu-card:hover img {
        transform: scale(1.1);
    }

    .menu-info {
        padding: 1.5rem;
    }

    .menu-header-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
    }

    .menu-card h3 {
        font-size: 1.3rem;
        color: var(--text-primary);
        margin: 0;
    }

    .menu-price {
        color: var(--primary-gold);
        font-weight: 700;
        font-size: 1.2rem;
    }

    .menu-category {
        color: var(--text-secondary);
        font-size: 0.85rem;
        margin-bottom: 0.5rem;
    }

    .menu-description {
        color: var(--text-secondary);
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .quantity-selector {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .qty-btn {
        background: var(--card-bg);
        border: 1px solid var(--primary-gold);
        color: var(--primary-gold);
        width: 35px;
        height: 35px;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1.2rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .qty-btn:hover {
        background: var(--primary-gold);
        color: var(--dark-bg);
    }

    .qty-input {
        width: 60px;
        text-align: center;
        background: var(--darker-bg);
        border: 1px solid rgba(212, 175, 55, 0.2);
        color: var(--text-primary);
        padding: 0.5rem;
        border-radius: 8px;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--text-secondary);
    }

    .empty-state i {
        font-size: 4rem;
        color: var(--primary-gold);
        margin-bottom: 1rem;
    }

    .search-box {
        max-width: 500px;
        margin: 0 auto 2rem;
    }

    .search-input {
        width: 100%;
        padding: 0.75rem 1.5rem;
        background: var(--card-bg);
        border: 1px solid rgba(212, 175, 55, 0.2);
        border-radius: 50px;
        color: var(--text-primary);
        font-size: 1rem;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--primary-gold);
    }

    @media (max-width: 768px) {
        .menu-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="menu-header">
        <h1 class="section-title">Our Menu</h1>
        <p class="menu-subtitle">Discover the finest Sri Lankan cuisine</p>

        <div class="search-box">
            <form method="GET" action="{{ route('menu.index') }}">
                <input type="text" name="search" class="search-input" 
                       placeholder="Search menu items..." 
                       value="{{ request('search') }}">
            </form>
        </div>
    </div>

    <div class="filters">
        <a href="{{ route('menu.index') }}" 
           class="filter-btn {{ !request('category') ? 'active' : '' }}">
            All Items
        </a>
        @foreach($categories as $category)
            <a href="{{ route('menu.index', ['category' => $category->slug]) }}" 
               class="filter-btn {{ request('category') == $category->slug ? 'active' : '' }}">
                {{ $category->name }} ({{ $category->menu_items_count }})
            </a>
        @endforeach
    </div>

    @if($menuItems->count() > 0)
        <div class="menu-grid">
            @foreach($menuItems as $item)
                <div class="menu-card">
                    <img src="{{ $item->image_url }}" alt="{{ $item->name }}">
                    <div class="menu-info">
                        <div class="menu-category">
                            <i class="bi bi-tag"></i> {{ $item->category->name }}
                        </div>
                        <div class="menu-header-info">
                            <h3>{{ $item->name }}</h3>
                            <span class="menu-price">Rs. {{ number_format($item->price, 2) }}</span>
                        </div>
                        <p class="menu-description">{{ $item->description }}</p>

                        @auth
                            <form class="add-to-cart-form" data-item-id="{{ $item->id }}">
                                @csrf
                                <div class="quantity-selector">
                                    <button type="button" class="qty-btn qty-minus">-</button>
                                    <input type="number" name="quantity" value="1" min="1" max="99" class="qty-input" readonly>
                                    <button type="button" class="qty-btn qty-plus">+</button>
                                </div>
                                <button type="submit" class="btn" style="width: 100%;">
                                    <i class="bi bi-cart-plus"></i> Add to Cart
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn" style="width: 100%; display: block;">
                                <i class="bi bi-lock"></i> Login to Order
                            </a>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <i class="bi bi-search"></i>
            <h3>No items found</h3>
            <p>Try adjusting your search or filters</p>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    // Quantity controls
    document.querySelectorAll('.qty-minus').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.parentElement.querySelector('.qty-input');
            if (input.value > 1) {
                input.value = parseInt(input.value) - 1;
            }
        });
    });

    document.querySelectorAll('.qty-plus').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.parentElement.querySelector('.qty-input');
            if (input.value < 99) {
                input.value = parseInt(input.value) + 1;
            }
        });
    });

    // Add to cart
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const itemId = this.dataset.itemId;
            const quantity = this.querySelector('.qty-input').value;
            const button = this.querySelector('button[type="submit"]');
            const originalText = button.innerHTML;
            
            button.disabled = true;
            button.innerHTML = '<i class="bi bi-hourglass-split"></i> Adding...';
            
            try {
                const response = await fetch(`/cart/add/${itemId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ quantity: parseInt(quantity) })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    button.innerHTML = '<i class="bi bi-check-circle"></i> Added!';
                    
                    // Update cart badge
                    const cartBadge = document.querySelector('.cart-badge .badge');
                    if (cartBadge) {
                        cartBadge.textContent = data.cart_count;
                    } else if (data.cart_count > 0) {
                        const cartIcon = document.querySelector('.cart-badge');
                        const badge = document.createElement('span');
                        badge.className = 'badge';
                        badge.textContent = data.cart_count;
                        cartIcon.appendChild(badge);
                    }
                    
                    setTimeout(() => {
                        button.innerHTML = originalText;
                        button.disabled = false;
                        this.querySelector('.qty-input').value = 1;
                    }, 1500);
                }
            } catch (error) {
                button.innerHTML = originalText;
                button.disabled = false;
                alert('Failed to add item to cart. Please try again.');
            }
        });
    });
</script>
@endsection

