<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel - Daiyaa Restaurant')</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-gold: #D4AF37;
            --dark-bg: #0a0a0a;
            --darker-bg: #050505;
            --card-bg: #1a1a1a;
            --text-primary: #ffffff;
            --text-secondary: #b0b0b0;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #17a2b8;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--dark-bg);
            color: var(--text-primary);
            overflow-x: hidden;
            line-height: 1.6;
            display: flex;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: var(--darker-bg);
            min-height: 100vh;
            border-right: 1px solid rgba(212, 175, 55, 0.1);
            position: fixed;
            left: 0;
            top: 0;
        }

        .sidebar-header {
            padding: 2rem;
            border-bottom: 1px solid rgba(212, 175, 55, 0.1);
        }

        .logo {
            font-size: 2rem;
            font-weight: 900;
            color: var(--primary-gold);
            font-family: 'Playfair Display', serif;
            letter-spacing: 2px;
            text-decoration: none;
            display: block;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-item {
            list-style: none;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 2rem;
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(212, 175, 55, 0.1);
            color: var(--primary-gold);
            border-left-color: var(--primary-gold);
        }

        .nav-link i {
            font-size: 1.2rem;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            flex: 1;
            min-height: 100vh;
        }

        .topbar {
            background: rgba(10, 10, 10, 0.95);
            border-bottom: 1px solid rgba(212, 175, 55, 0.1);
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            font-size: 1.5rem;
            color: var(--primary-gold);
        }

        .user-menu {
            color: var(--text-secondary);
        }

        .container-admin {
            padding: 2rem;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            padding: 0.75rem 2rem;
            background: var(--primary-gold);
            color: var(--dark-bg);
            text-decoration: none;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
            border: 2px solid var(--primary-gold);
            cursor: pointer;
        }

        .btn:hover {
            background: transparent;
            color: var(--primary-gold);
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }

        .btn-danger {
            background: var(--danger);
            border-color: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background: transparent;
            color: var(--danger);
        }

        /* Cards */
        .card {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 2rem;
            border: 1px solid rgba(212, 175, 55, 0.1);
        }

        /* Forms */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            background: var(--darker-bg);
            border: 1px solid rgba(212, 175, 55, 0.2);
            border-radius: 8px;
            color: var(--text-primary);
            font-family: 'Poppins', sans-serif;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-gold);
        }

        select.form-control {
            cursor: pointer;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Table */
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            background: var(--darker-bg);
            color: var(--primary-gold);
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            border-bottom: 2px solid rgba(212, 175, 55, 0.3);
        }

        .table td {
            padding: 1rem;
            border-bottom: 1px solid rgba(212, 175, 55, 0.1);
        }

        .table tr:hover {
            background: rgba(212, 175, 55, 0.05);
        }

        /* Alert */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.1);
            border: 1px solid var(--success);
            color: var(--success);
        }

        .alert-error {
            background: rgba(220, 53, 69, 0.1);
            border: 1px solid var(--danger);
            color: var(--danger);
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            position: fixed;
            top: 1.5rem;
            left: 1rem;
            z-index: 1001;
            background: var(--primary-gold);
            border: none;
            color: var(--dark-bg);
            width: 40px;
            height: 40px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.2rem;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 998;
        }

        .sidebar-overlay.active {
            display: block;
        }

        /* Responsive Styles */
        @media (max-width: 968px) {
            .mobile-menu-toggle {
                display: block;
            }

            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 999;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .topbar {
                padding-left: 4rem;
            }

            .page-title {
                font-size: 1.2rem;
            }

            .container-admin {
                padding: 1.5rem;
            }

            .table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .card {
                padding: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            .topbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .container-admin {
                padding: 1rem;
            }
        }

        @yield('styles')
    </style>
</head>
<body>
    <!-- Mobile Menu Toggle -->
    <button class="mobile-menu-toggle" id="mobileMenuToggle">
        <i class="bi bi-list"></i>
    </button>

    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('admin.dashboard') }}" class="logo">DAIYAA</a>
            <p style="color: var(--text-secondary); font-size: 0.9rem; margin-top: 0.5rem;">Admin Panel</p>
        </div>
        
        <ul class="sidebar-nav">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <i class="bi bi-receipt"></i>
                    <span>Orders</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.menu-items.index') }}" class="nav-link {{ request()->routeIs('admin.menu-items.*') ? 'active' : '' }}">
                    <i class="bi bi-card-list"></i>
                    <span>Menu Items</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.promotions.index') }}" class="nav-link {{ request()->routeIs('admin.promotions.*') ? 'active' : '' }}">
                    <i class="bi bi-gift"></i>
                    <span>Promotions</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('menu.index') }}" class="nav-link">
                    <i class="bi bi-globe"></i>
                    <span>View Website</span>
                </a>
            </li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <a href="#" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>
                </form>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <div class="topbar">
            <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
            <div class="user-menu">
                <i class="bi bi-person-circle"></i>
                <span>{{ auth()->user()->name }}</span>
            </div>
        </div>

        <div class="container-admin">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script>
        // Mobile menu toggle
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        if (mobileMenuToggle && sidebar && sidebarOverlay) {
            mobileMenuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                sidebarOverlay.classList.toggle('active');
                
                const icon = this.querySelector('i');
                if (sidebar.classList.contains('active')) {
                    icon.classList.remove('bi-list');
                    icon.classList.add('bi-x');
                } else {
                    icon.classList.remove('bi-x');
                    icon.classList.add('bi-list');
                }
            });

            // Close sidebar when clicking overlay
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                const icon = mobileMenuToggle.querySelector('i');
                icon.classList.remove('bi-x');
                icon.classList.add('bi-list');
            });

            // Close sidebar when clicking a nav link on mobile
            const navLinks = sidebar.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 968) {
                        sidebar.classList.remove('active');
                        sidebarOverlay.classList.remove('active');
                        const icon = mobileMenuToggle.querySelector('i');
                        icon.classList.remove('bi-x');
                        icon.classList.add('bi-list');
                    }
                });
            });
        }
    </script>

    @yield('scripts')
</body>
</html>

