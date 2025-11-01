<style>
    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background: rgba(10, 10, 10, 0.95);
        backdrop-filter: blur(10px);
        padding: 1.2rem 0;
        z-index: 1000;
        border-bottom: 1px solid rgba(212, 175, 55, 0.1);
        transition: all 0.3s ease;
    }

    .navbar.scrolled {
        padding: 0.8rem 0;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
    }

    .nav-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        font-size: 2rem;
        font-weight: 900;
        color: var(--primary-gold);
        font-family: 'Playfair Display', serif;
        letter-spacing: 2px;
        text-decoration: none;
    }

    .nav-links {
        display: flex;
        gap: 2.5rem;
        list-style: none;
        align-items: center;
    }

    .nav-links a {
        color: var(--text-primary);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
        position: relative;
    }

    .nav-links a::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--primary-gold);
        transition: width 0.3s ease;
    }

    .nav-links a:hover::after {
        width: 100%;
    }

    .nav-links a:hover {
        color: var(--primary-gold);
    }

    .cart-badge {
        position: relative;
        font-size: 1.3rem;
    }

    .cart-badge .badge {
        position: absolute;
        top: -8px;
        right: -12px;
        background: var(--accent-red);
        color: white;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 0.7rem;
        font-weight: 600;
        min-width: 20px;
        text-align: center;
    }

    .btn-nav {
        background: var(--primary-gold);
        color: var(--dark-bg);
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .btn-nav:hover {
        background: transparent;
        color: var(--primary-gold);
        border: 1px solid var(--primary-gold);
    }

    .mobile-menu-toggle {
        display: none;
        background: none;
        border: none;
        color: var(--primary-gold);
        font-size: 1.8rem;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .mobile-menu-toggle {
            display: block;
        }

        .nav-links {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: rgba(10, 10, 10, 0.98);
            flex-direction: column;
            padding: 1rem 0;
            border-top: 1px solid rgba(212, 175, 55, 0.2);
        }

        .nav-links.active {
            display: flex;
        }

        .nav-links li {
            width: 100%;
            text-align: center;
        }

        .nav-links a {
            display: block;
            padding: 1rem;
        }

        .logo {
            font-size: 1.5rem;
        }
    }
</style>

<nav class="navbar" id="navbar">
    <div class="nav-container">
        <a href="{{ route('home') }}" class="logo">DAIYAA</a>
        <button class="mobile-menu-toggle" id="mobileMenuToggle">
            <i class="bi bi-list"></i>
        </button>
        <ul class="nav-links" id="navLinks">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('home') }}#about">About</a></li>
            <li><a href="{{ route('menu.index') }}">Order Online</a></li>
            <li><a href="{{ route('home') }}#gallery">Gallery</a></li>
            <li><a href="{{ route('home') }}#contact">Contact</a></li>
            @auth
                <li><a href="{{ route('orders.index') }}">My Orders</a></li>
                <li>
                    <a href="{{ route('cart.index') }}" class="cart-badge">
                        <i class="bi bi-cart3"></i>
                        @if(auth()->user()->cart_count > 0)
                            <span class="badge">{{ auth()->user()->cart_count }}</span>
                        @endif
                    </a>
                </li>
                @if(auth()->user()->is_admin)
                    <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                @endif
                <li>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline; margin: 0;">
                        @csrf
                        <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" style="cursor: pointer;">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}"><i class="bi bi-person"></i> Login</a></li>
                <li><a href="{{ route('register') }}" class="btn-nav">Sign Up</a></li>
            @endauth
        </ul>
    </div>
</nav>

<script>
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar');
        if (navbar && window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else if (navbar) {
            navbar.classList.remove('scrolled');
        }
    });

    // Mobile menu toggle
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const navLinks = document.getElementById('navLinks');
    
    if (mobileMenuToggle && navLinks) {
        mobileMenuToggle.addEventListener('click', function() {
            navLinks.classList.toggle('active');
            const icon = this.querySelector('i');
            if (navLinks.classList.contains('active')) {
                icon.classList.remove('bi-list');
                icon.classList.add('bi-x');
            } else {
                icon.classList.remove('bi-x');
                icon.classList.add('bi-list');
            }
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!mobileMenuToggle.contains(event.target) && !navLinks.contains(event.target)) {
                if (navLinks.classList.contains('active')) {
                    navLinks.classList.remove('active');
                    const icon = mobileMenuToggle.querySelector('i');
                    icon.classList.remove('bi-x');
                    icon.classList.add('bi-list');
                }
            }
        });

        // Close mobile menu on link click
        navLinks.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function() {
                if (navLinks.classList.contains('active')) {
                    navLinks.classList.remove('active');
                    const icon = mobileMenuToggle.querySelector('i');
                    icon.classList.remove('bi-x');
                    icon.classList.add('bi-list');
                }
            });
        });
    }
</script>

