@props(['active' => 'general'])

<style>
    .settings-layout {
        display: flex;
        gap: 2.5rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    .settings-sidebar {
        min-width: 280px;
        background: linear-gradient(135deg, rgba(26, 26, 26, 0.98), rgba(15, 15, 15, 0.95));
        border-radius: 20px;
        padding: 0;
        height: fit-content;
        position: sticky;
        top: 100px;
        border: 1px solid rgba(212, 175, 55, 0.15);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4), 
                    0 0 0 1px rgba(212, 175, 55, 0.05);
        overflow: hidden;
    }

    .settings-sidebar-header {
        padding: 2rem 1.75rem 1.5rem;
        background: linear-gradient(135deg, rgba(212, 175, 55, 0.12), rgba(212, 175, 55, 0.05));
        border-bottom: 1px solid rgba(212, 175, 55, 0.15);
        position: relative;
    }

    .settings-sidebar-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--primary-gold), transparent);
        opacity: 0.5;
    }

    .settings-sidebar h3 {
        color: var(--primary-gold);
        font-size: 1.3rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        letter-spacing: 0.5px;
    }

    .settings-sidebar h3 i {
        font-size: 1.5rem;
        filter: drop-shadow(0 0 8px rgba(212, 175, 55, 0.3));
    }

    .settings-nav {
        display: flex;
        flex-direction: column;
        gap: 0.35rem;
        padding: 1.25rem 1rem;
    }

    .settings-nav-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.25rem;
        background: transparent;
        color: var(--text-secondary);
        text-decoration: none;
        border-radius: 12px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        font-weight: 500;
        font-size: 0.95rem;
        border: 1px solid transparent;
        position: relative;
        overflow: hidden;
    }

    .settings-nav-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 3px;
        background: var(--primary-gold);
        transform: scaleY(0);
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 0 3px 3px 0;
    }

    .settings-nav-item::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at var(--mouse-x, 50%) var(--mouse-y, 50%), 
                                   rgba(212, 175, 55, 0.1), 
                                   transparent 80%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .settings-nav-item i {
        font-size: 1.35rem;
        width: 28px;
        text-align: center;
        transition: all 0.3s ease;
        z-index: 1;
    }

    .settings-nav-item span {
        z-index: 1;
        transition: all 0.3s ease;
    }

    .settings-nav-item:hover {
        background: rgba(212, 175, 55, 0.08);
        color: var(--primary-gold);
        border-color: rgba(212, 175, 55, 0.25);
        transform: translateX(4px);
        box-shadow: 0 4px 12px rgba(212, 175, 55, 0.15);
    }

    .settings-nav-item:hover::after {
        opacity: 1;
    }

    .settings-nav-item:hover i {
        transform: scale(1.1);
        filter: drop-shadow(0 0 8px rgba(212, 175, 55, 0.4));
    }

    .settings-nav-item.active {
        background: linear-gradient(135deg, 
                                   rgba(212, 175, 55, 0.18), 
                                   rgba(212, 175, 55, 0.12));
        color: var(--primary-gold);
        border-color: rgba(212, 175, 55, 0.4);
        font-weight: 600;
        box-shadow: 0 4px 16px rgba(212, 175, 55, 0.25),
                    inset 0 1px 0 rgba(212, 175, 55, 0.2);
    }

    .settings-nav-item.active::before {
        transform: scaleY(1);
    }

    .settings-nav-item.active i {
        color: var(--primary-gold);
        filter: drop-shadow(0 0 10px rgba(212, 175, 55, 0.5));
        transform: scale(1.05);
    }

    .settings-content {
        flex: 1;
        min-width: 0;
    }

    .settings-badge {
        background: linear-gradient(135deg, var(--primary-gold), #C5A028);
        color: var(--dark-bg);
        padding: 0.3rem 0.6rem;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 700;
        margin-left: auto;
        box-shadow: 0 2px 8px rgba(212, 175, 55, 0.3);
        z-index: 1;
        letter-spacing: 0.5px;
    }

    /* Separator between nav groups (optional) */
    .settings-nav-separator {
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.2), transparent);
        margin: 0.75rem 1rem;
    }

    @media (max-width: 968px) {
        .settings-layout {
            flex-direction: column;
            gap: 1.5rem;
        }

        .settings-sidebar {
            position: relative;
            top: 0;
            min-width: 100%;
            border-radius: 15px;
        }

        .settings-sidebar-header {
            padding: 1.5rem 1.5rem 1.25rem;
        }

        .settings-sidebar h3 {
            font-size: 1.2rem;
            justify-content: center;
        }

        .settings-nav {
            flex-direction: row;
            flex-wrap: wrap;
            padding: 1rem 0.75rem;
            gap: 0.5rem;
        }

        .settings-nav-item {
            flex: 1;
            min-width: calc(33.333% - 0.35rem);
            justify-content: center;
            padding: 1rem 0.5rem;
        }

        .settings-nav-item span {
            display: none;
        }

        .settings-nav-item i {
            margin: 0;
            font-size: 1.5rem;
        }

        .settings-nav-item:hover {
            transform: translateY(-2px);
        }

        .settings-badge {
            position: absolute;
            top: 0.25rem;
            right: 0.25rem;
            padding: 0.2rem 0.4rem;
            font-size: 0.65rem;
        }
    }

    @media (max-width: 640px) {
        .settings-nav-item {
            min-width: calc(50% - 0.25rem);
        }
    }

    /* Smooth scroll behavior */
    @media (prefers-reduced-motion: no-preference) {
        .settings-nav-item {
            scroll-behavior: smooth;
        }
    }

    /* Focus styles for accessibility */
    .settings-nav-item:focus {
        outline: 2px solid var(--primary-gold);
        outline-offset: 2px;
    }

    .settings-nav-item:focus:not(:focus-visible) {
        outline: none;
    }
</style>

<div class="settings-sidebar">
    <div class="settings-sidebar-header">
        <h3>
            <i class="bi bi-gear-fill"></i>
            <span>Settings</span>
        </h3>
    </div>
    
    <nav class="settings-nav">
        <a href="{{ route('admin.settings.general') }}" 
           class="settings-nav-item {{ $active === 'general' ? 'active' : '' }}"
           aria-label="General Settings"
           title="General Settings">
            <i class="bi bi-house-fill"></i>
            <span>General</span>
        </a>
        
        <a href="{{ route('admin.settings.contact') }}" 
           class="settings-nav-item {{ $active === 'contact' ? 'active' : '' }}"
           aria-label="Contact Information"
           title="Contact Information">
            <i class="bi bi-telephone-fill"></i>
            <span>Contact Info</span>
        </a>
        
        <a href="{{ route('admin.settings.hours') }}" 
           class="settings-nav-item {{ $active === 'hours' ? 'active' : '' }}"
           aria-label="Business Hours"
           title="Business Hours">
            <i class="bi bi-clock-fill"></i>
            <span>Business Hours</span>
        </a>
        
        <!-- Optional separator for visual grouping -->
        <div class="settings-nav-separator"></div>
        
        <a href="{{ route('admin.settings.social') }}" 
           class="settings-nav-item {{ $active === 'social' ? 'active' : '' }}"
           aria-label="Social Media Settings"
           title="Social Media Settings">
            <i class="bi bi-share-fill"></i>
            <span>Social Media</span>
            <span class="settings-badge">11</span>
        </a>
        
        <a href="{{ route('admin.settings.seo') }}" 
           class="settings-nav-item {{ $active === 'seo' ? 'active' : '' }}"
           aria-label="SEO Settings"
           title="SEO Settings">
            <i class="bi bi-search"></i>
            <span>SEO Settings</span>
        </a>
        
        <!-- Optional separator -->
        <div class="settings-nav-separator"></div>
        
        <a href="{{ route('admin.settings.delivery') }}" 
           class="settings-nav-item {{ $active === 'delivery' ? 'active' : '' }}"
           aria-label="Delivery & Payment Settings"
           title="Delivery & Payment Settings">
            <i class="bi bi-truck"></i>
            <span>Delivery & Payment</span>
        </a>
        
        <a href="{{ route('admin.settings.email') }}" 
           class="settings-nav-item {{ $active === 'email' ? 'active' : '' }}"
           aria-label="Email Settings"
           title="Email Settings">
            <i class="bi bi-envelope-fill"></i>
            <span>Email Settings</span>
        </a>
        
        <a href="{{ route('admin.settings.features') }}" 
           class="settings-nav-item {{ $active === 'features' ? 'active' : '' }}"
           aria-label="Feature Settings"
           title="Feature Settings">
            <i class="bi bi-toggles"></i>
            <span>Features</span>
        </a>
    </nav>
</div>

