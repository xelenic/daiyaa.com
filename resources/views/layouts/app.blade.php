<!DOCTYPE html>
<html lang="{{ setting('site_language', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- SEO Meta Tags -->
    <title>@yield('title', setting('seo_title', setting('site_name')))</title>
    <meta name="description" content="@yield('description', setting('seo_description', setting('site_description')))">
    <meta name="keywords" content="{{ setting('seo_keywords') }}">
    <meta name="author" content="{{ setting('site_name') }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', setting('seo_title'))">
    <meta property="og:description" content="@yield('description', setting('seo_description'))">
    <meta property="og:site_name" content="{{ setting('site_name') }}">
    @if(setting('seo_og_image'))
        <meta property="og:image" content="{{ url(setting('seo_og_image')) }}">
    @endif
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', setting('seo_title'))">
    <meta name="twitter:description" content="@yield('description', setting('seo_description'))">
    
    <!-- Favicon -->
    @if(setting('site_favicon'))
        <link rel="icon" href="{{ setting('site_favicon') }}">
        <link rel="apple-touch-icon" href="{{ setting('site_favicon') }}">
    @endif
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Google Analytics -->
    @if(setting('seo_google_analytics_id'))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ setting('seo_google_analytics_id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ setting('seo_google_analytics_id') }}');
        </script>
    @endif
    
    <!-- Google Tag Manager -->
    @if(setting('seo_google_tag_manager_id'))
        <script>
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','{{ setting('seo_google_tag_manager_id') }}');
        </script>
    @endif
    
    <!-- Facebook Pixel -->
    @if(setting('seo_facebook_pixel_id'))
        <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '{{ setting('seo_facebook_pixel_id') }}');
            fbq('track', 'PageView');
        </script>
        <noscript>
            <img height="1" width="1" style="display:none"
                 src="https://www.facebook.com/tr?id={{ setting('seo_facebook_pixel_id') }}&ev=PageView&noscript=1"/>
        </noscript>
    @endif
    
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
            --accent-red: #8B0000;
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
            padding-top: 80px;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }

        /* Navigation styles moved to navbar component */

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .section-title {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--primary-gold);
            text-align: center;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            padding: 0.75rem 2rem;
            background: var(--primary-gold);
            color: var(--dark-bg);
            text-decoration: none;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            border: 2px solid var(--primary-gold);
            cursor: pointer;
            text-align: center;
        }

        .btn:hover {
            background: transparent;
            color: var(--primary-gold);
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(212, 175, 55, 0.3);
        }

        .btn-outline {
            background: transparent;
            color: var(--primary-gold);
        }

        .btn-outline:hover {
            background: var(--primary-gold);
            color: var(--dark-bg);
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

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }

        /* Cards */
        .card {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 2rem;
            border: 1px solid rgba(212, 175, 55, 0.1);
            transition: all 0.3s ease;
        }

        .card:hover {
            border-color: var(--primary-gold);
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.2);
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
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        }

        .form-control::placeholder {
            color: var(--text-secondary);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .form-error {
            color: var(--danger);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        /* Alerts */
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

        .alert-info {
            background: rgba(23, 162, 184, 0.1);
            border: 1px solid var(--info);
            color: var(--info);
        }

        /* Footer */
        .footer {
            background: var(--darker-bg);
            padding: 3rem 2rem;
            text-align: center;
            border-top: 1px solid rgba(212, 175, 55, 0.1);
            margin-top: 4rem;
        }

        .footer-text {
            color: var(--text-secondary);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }
        }

        @yield('styles')
    </style>
</head>
<body>
    <!-- Navigation -->
    @include('components.navbar')

    <!-- Main Content -->
    <main>
        @if(session('success'))
            <div class="container">
                <div class="alert alert-success">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="container">
                <div class="alert alert-error">
                    <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        @if(setting('site_logo'))
            <div style="margin-bottom: 1rem;">
                <img src="{{ setting('site_logo') }}" alt="{{ setting('site_name', 'Daiyaa') }}" style="max-height: 80px; width: auto; object-fit: contain;">
            </div>
        @else
            <div class="logo" style="font-size: 2rem; margin-bottom: 1rem;">{{ strtoupper(setting('site_name', 'DAIYAA')) }}</div>
        @endif
        
        <p class="footer-text" style="margin-bottom: 0.5rem;">
            {{ setting('site_tagline') }}
        </p>
        
        <!-- Contact Info -->
        <p class="footer-text" style="margin-bottom: 1rem;">
            @if(setting('contact_address'))
                {{ setting('contact_address') }}<br>
            @endif
            @if(setting('contact_phone'))
                <a href="tel:{{ setting('contact_phone') }}" style="color: var(--primary-gold); text-decoration: none;">
                    {{ setting('contact_phone') }}
                </a>
            @endif
            @if(setting('contact_phone') && (setting('contact_email') || setting('contact_email_support')))
                |
            @endif
            @if(setting('contact_email_support'))
                <a href="mailto:{{ setting('contact_email_support') }}" style="color: var(--primary-gold); text-decoration: none;">
                    {{ setting('contact_email_support') }}
                </a>
            @endif
            @if(setting('contact_email_support') && setting('contact_email'))
                |
            @endif
            @if(setting('contact_email'))
                <a href="mailto:{{ setting('contact_email') }}" style="color: var(--primary-gold); text-decoration: none;">
                    {{ setting('contact_email') }}
                </a>
            @endif
        </p>
        
        <!-- Social Links -->
        <div style="margin-bottom: 1.5rem;">
            <x-social-links iconSize="1.5rem" />
        </div>
        
        <!-- Copyright -->
        <p class="footer-text" style="font-size: 0.875rem;">
            {{ setting('site_footer_text', '© ' . date('Y') . ' ' . setting('site_name') . '. All rights reserved.') }}
        </p>
    </footer>

    @yield('scripts')
</body>
</html>

