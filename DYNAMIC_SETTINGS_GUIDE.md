# Dynamic Settings Implementation Guide

## 🎯 Overview

Your website now has a comprehensive dynamic settings system with **70+ configurable options** across 8 categories. All settings are managed from the admin panel and automatically cached for performance.

---

## 📋 Setting Categories

### 1️⃣ General Settings
- Website name, tagline, and description
- Logo and favicon
- Footer text
- Currency and language settings

### 2️⃣ Contact Information
- Phone numbers (primary & secondary)
- Email addresses (info & support)
- WhatsApp number
- Physical address with city, postal code, country
- Google Maps coordinates and embed URL

### 3️⃣ Business Hours
- Opening and closing times
- Operating days
- Special hours notes

### 4️⃣ Social Media
- Facebook, Instagram, Twitter/X
- YouTube, TikTok, LinkedIn
- Pinterest, Telegram, Snapchat
- TripAdvisor, Yelp

### 5️⃣ SEO Settings
- Meta title and description
- Keywords
- Open Graph image
- Google Analytics GA4
- Google Tag Manager
- Facebook Pixel

### 6️⃣ Delivery & Payment
- Minimum order amount
- Delivery fee and free delivery threshold
- Delivery radius and estimated time
- Cash on delivery toggle
- Online payments toggle

### 7️⃣ Features
- Online ordering
- Promotions popup
- Table reservations
- Customer reviews
- Newsletter signup
- Loyalty program
- Maintenance mode

### 8️⃣ Email Settings
- From name and address
- Order confirmation emails
- Admin notifications

---

## 🚀 How to Use Settings

### Basic Usage in Blade Templates

```blade
<!-- Get website name -->
<h1>{{ setting('site_name') }}</h1>

<!-- Get with default value -->
<p>{{ setting('site_tagline', 'Default Tagline') }}</p>

<!-- Check if feature is enabled -->
@if(setting('feature_online_ordering') == '1')
    <button>Order Now</button>
@endif

<!-- Display contact info -->
<a href="tel:{{ setting('contact_phone') }}">
    Call: {{ setting('contact_phone') }}
</a>

<a href="mailto:{{ setting('contact_email') }}">
    Email: {{ setting('contact_email') }}
</a>
```

### Using in HTML Head (SEO)

```blade
<!DOCTYPE html>
<html lang="{{ setting('site_language', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <title>{{ setting('seo_title', setting('site_name')) }}</title>
    <meta name="description" content="{{ setting('seo_description') }}">
    <meta name="keywords" content="{{ setting('seo_keywords') }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="{{ setting('seo_title') }}">
    <meta property="og:description" content="{{ setting('seo_description') }}">
    @if(setting('seo_og_image'))
        <meta property="og:image" content="{{ url(setting('seo_og_image')) }}">
    @endif
    
    <!-- Favicon -->
    @if(setting('site_favicon'))
        <link rel="icon" href="{{ setting('site_favicon') }}">
    @endif
    
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
    @endif
</head>
```

### Header with Logo

```blade
<header>
    <div class="logo">
        @if(setting('site_logo'))
            <img src="{{ setting('site_logo') }}" alt="{{ setting('site_name') }}">
        @else
            <h1>{{ setting('site_name') }}</h1>
        @endif
    </div>
    <p>{{ setting('site_tagline') }}</p>
</header>
```

### Footer Implementation

```blade
<footer>
    <div class="footer-content">
        <!-- Company Info -->
        <div class="footer-section">
            <h3>{{ setting('site_name') }}</h3>
            <p>{{ setting('site_description') }}</p>
        </div>
        
        <!-- Contact Info -->
        <div class="footer-section">
            <h4>Contact Us</h4>
            <p>
                <i class="bi bi-telephone"></i> 
                {{ setting('contact_phone') }}
            </p>
            @if(setting('contact_phone_secondary'))
                <p>
                    <i class="bi bi-telephone"></i> 
                    {{ setting('contact_phone_secondary') }}
                </p>
            @endif
            <p>
                <i class="bi bi-envelope"></i> 
                {{ setting('contact_email') }}
            </p>
            <p>
                <i class="bi bi-geo-alt"></i> 
                {{ setting('contact_address') }}
            </p>
        </div>
        
        <!-- Business Hours -->
        <div class="footer-section">
            <h4>Hours</h4>
            <p>{{ setting('hours_days') }}</p>
            <p>{{ setting('hours_open') }} - {{ setting('hours_close') }}</p>
            @if(setting('hours_special_note'))
                <small>{{ setting('hours_special_note') }}</small>
            @endif
        </div>
        
        <!-- Social Media Links (using component) -->
        <div class="footer-section">
            <h4>Follow Us</h4>
            <x-social-links iconSize="2rem" />
        </div>
    </div>
    
    <!-- Copyright -->
    <div class="footer-bottom">
        <p>{{ setting('site_footer_text') }}</p>
    </div>
</footer>
```

### Social Links Component

```blade
<!-- Simple usage -->
<x-social-links />

<!-- Custom icon size -->
<x-social-links iconSize="2rem" />

<!-- Custom class -->
<x-social-links class="my-social-links" iconSize="1.8rem" />
```

### WhatsApp Click-to-Chat Button

```blade
@if(setting('contact_whatsapp'))
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('contact_whatsapp')) }}" 
       class="whatsapp-button" 
       target="_blank"
       rel="noopener noreferrer">
        <i class="bi bi-whatsapp"></i> Chat on WhatsApp
    </a>
@endif
```

### Google Maps Integration

```blade
<!-- Using embed URL -->
@if(setting('contact_map_embed_url'))
    <div class="map-container">
        <iframe 
            src="{{ setting('contact_map_embed_url') }}" 
            width="100%" 
            height="450" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
@endif

<!-- Or using coordinates for custom map -->
@if(setting('contact_map_latitude') && setting('contact_map_longitude'))
    <a href="https://www.google.com/maps?q={{ setting('contact_map_latitude') }},{{ setting('contact_map_longitude') }}" 
       target="_blank">
        View on Google Maps
    </a>
@endif
```

### Delivery Information Display

```blade
<div class="delivery-info">
    <h3>Delivery Information</h3>
    
    @if(setting('feature_online_ordering') == '1')
        <p>
            <strong>Minimum Order:</strong> 
            {{ setting('site_currency_symbol') }}{{ setting('delivery_minimum_order') }}
        </p>
        
        <p>
            <strong>Delivery Fee:</strong> 
            {{ setting('site_currency_symbol') }}{{ setting('delivery_fee') }}
        </p>
        
        <p>
            <strong>Free Delivery:</strong> 
            Orders above {{ setting('site_currency_symbol') }}{{ setting('delivery_free_above') }}
        </p>
        
        <p>
            <strong>Delivery Radius:</strong> 
            {{ setting('delivery_radius') }} km
        </p>
        
        <p>
            <strong>Estimated Time:</strong> 
            {{ setting('delivery_estimated_time') }}
        </p>
    @else
        <p>Online ordering is currently unavailable.</p>
    @endif
</div>
```

### Currency Formatting Helper

```blade
<!-- Display price with currency -->
@php
    function formatPrice($amount) {
        return setting('site_currency_symbol', 'Rs') . ' ' . number_format($amount, 2);
    }
@endphp

<p class="price">{{ formatPrice(1500) }}</p>
<!-- Output: Rs 1,500.00 -->
```

### Maintenance Mode Check

Add this to your main layout or middleware:

```blade
@if(setting('maintenance_mode') == '1' && !auth()->user()?->is_admin)
    <div class="maintenance-page">
        <h1>We'll be back soon!</h1>
        <p>{{ setting('site_name') }} is currently undergoing maintenance.</p>
        <p>Please check back later.</p>
    </div>
    @php
        exit;
    @endphp
@endif
```

### Conditional Features

```blade
<!-- Online Ordering -->
@if(setting('feature_online_ordering') == '1')
    <a href="{{ route('menu') }}" class="btn">Order Online</a>
@endif

<!-- Table Reservations -->
@if(setting('feature_table_reservation') == '1')
    <a href="{{ route('reservations') }}" class="btn">Book a Table</a>
@endif

<!-- Customer Reviews -->
@if(setting('feature_customer_reviews') == '1')
    <div class="reviews-section">
        <!-- Display reviews here -->
    </div>
@endif

<!-- Newsletter Signup -->
@if(setting('feature_newsletter') == '1')
    <form method="POST" action="{{ route('newsletter.subscribe') }}">
        @csrf
        <input type="email" name="email" placeholder="Your email">
        <button type="submit">Subscribe</button>
    </form>
@endif

<!-- Promotions Popup -->
@if(setting('feature_promotions') == '1')
    <!-- Show promotion modal -->
@endif
```

---

## 🔧 Usage in Controllers

```php
namespace App\Http\Controllers;

use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        // Get individual setting
        $siteName = setting('site_name');
        
        // Or using the model
        $siteName = Setting::get('site_name', 'Default Name');
        
        // Set a setting programmatically
        Setting::set('site_name', 'New Restaurant Name');
        
        // Check feature flag
        if (setting('feature_online_ordering') == '1') {
            // Show ordering interface
        }
        
        // Pass to view
        return view('welcome', [
            'siteName' => $siteName,
        ]);
    }
}
```

---

## 📧 Email Configuration

Use settings in your mail configuration or email templates:

```php
// In your mail class
public function build()
{
    return $this->from(
        setting('email_from_address', 'noreply@example.com'),
        setting('email_from_name', 'Restaurant')
    )
    ->subject('Order Confirmation - ' . setting('site_name'))
    ->view('emails.order-confirmation');
}
```

---

## 🎨 Structured Data / Schema.org

```blade
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Restaurant",
    "name": "{{ setting('site_name') }}",
    "description": "{{ setting('site_description') }}",
    "telephone": "{{ setting('contact_phone') }}",
    "email": "{{ setting('contact_email') }}",
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "{{ setting('contact_address') }}",
        "addressLocality": "{{ setting('contact_city') }}",
        "postalCode": "{{ setting('contact_postal_code') }}",
        "addressCountry": "{{ setting('contact_country') }}"
    },
    "geo": {
        "@type": "GeoCoordinates",
        "latitude": "{{ setting('contact_map_latitude') }}",
        "longitude": "{{ setting('contact_map_longitude') }}"
    },
    "openingHours": "Mo-Su {{ setting('hours_open') }}-{{ setting('hours_close') }}",
    "priceRange": "{{ setting('site_currency_symbol') }}",
    "servesCuisine": "Sri Lankan",
    "sameAs": [
        "{{ setting('social_facebook') }}",
        "{{ setting('social_instagram') }}",
        "{{ setting('social_twitter') }}"
    ]
}
</script>
```

---

## 🔄 Running the Seeder

To populate all settings in your database:

```bash
# Run the settings seeder
php artisan db:seed --class=SettingSeeder

# Or run all seeders
php artisan db:seed
```

---

## 🎯 Admin Panel Access

1. Login to admin panel: `/admin/login`
2. Navigate to **Settings** menu
3. Click through tabs to edit different setting groups:
   - **General** - Website basics
   - **Contact** - Contact information
   - **Hours** - Business hours
   - **Social** - Social media links
   - **SEO** - Search engine optimization
   - **Delivery** - Delivery & payment options
   - **Email** - Email configuration
   - **Features** - Toggle features on/off

4. Click **Update Settings** to save changes

---

## 💾 Caching

All settings are automatically cached for performance:

```php
// Cache is handled automatically
$value = setting('site_name'); // Cached

// Clear cache after bulk updates
Setting::clearCache();

// Or clear all cache
php artisan cache:clear
```

---

## ✅ Best Practices

1. **Always provide defaults:**
   ```blade
   {{ setting('site_name', 'Default Restaurant Name') }}
   ```

2. **Check feature flags before displaying:**
   ```blade
   @if(setting('feature_online_ordering') == '1')
       <!-- Show ordering interface -->
   @endif
   ```

3. **Use helper function for convenience:**
   ```blade
   {{ setting('key') }} ✅
   {{ Setting::get('key') }} ⚠️ (also works but longer)
   ```

4. **Clear cache after programmatic updates:**
   ```php
   Setting::set('key', 'value');
   Setting::clearCache();
   ```

5. **Sanitize user input for URLs:**
   ```blade
   <a href="{{ setting('social_facebook') }}" target="_blank" rel="noopener noreferrer">
   ```

---

## 🆕 Adding Custom Settings

### Method 1: Via Seeder (Recommended)

Edit `database/seeders/SettingSeeder.php`:

```php
[
    'key' => 'my_custom_setting',
    'value' => 'Default Value',
    'type' => 'text', // text, textarea, select, toggle, image
    'label' => 'My Custom Setting',
    'group' => 'general', // or create new group
    'order' => 10,
    'options' => null, // For select type, provide array
],
```

Then run:
```bash
php artisan db:seed --class=SettingSeeder
```

### Method 2: Programmatically

```php
use App\Models\Setting;

Setting::create([
    'key' => 'custom_setting',
    'value' => 'value',
    'type' => 'text',
    'label' => 'Custom Setting',
    'group' => 'general',
    'order' => 99,
]);
```

---

## 📱 Example: Complete Contact Page

```blade
@extends('layouts.app')

@section('content')
<div class="contact-page">
    <h1>Contact {{ setting('site_name') }}</h1>
    
    <div class="contact-grid">
        <!-- Contact Info -->
        <div class="contact-info">
            <h2>Get in Touch</h2>
            
            <div class="info-item">
                <i class="bi bi-telephone-fill"></i>
                <div>
                    <strong>Primary Phone</strong>
                    <a href="tel:{{ setting('contact_phone') }}">
                        {{ setting('contact_phone') }}
                    </a>
                </div>
            </div>
            
            @if(setting('contact_phone_secondary'))
                <div class="info-item">
                    <i class="bi bi-telephone"></i>
                    <div>
                        <strong>Secondary Phone</strong>
                        <a href="tel:{{ setting('contact_phone_secondary') }}">
                            {{ setting('contact_phone_secondary') }}
                        </a>
                    </div>
                </div>
            @endif
            
            <div class="info-item">
                <i class="bi bi-envelope-fill"></i>
                <div>
                    <strong>Email</strong>
                    <a href="mailto:{{ setting('contact_email') }}">
                        {{ setting('contact_email') }}
                    </a>
                </div>
            </div>
            
            @if(setting('contact_whatsapp'))
                <div class="info-item">
                    <i class="bi bi-whatsapp"></i>
                    <div>
                        <strong>WhatsApp</strong>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('contact_whatsapp')) }}" 
                           target="_blank">
                            {{ setting('contact_whatsapp') }}
                        </a>
                    </div>
                </div>
            @endif
            
            <div class="info-item">
                <i class="bi bi-geo-alt-fill"></i>
                <div>
                    <strong>Address</strong>
                    <p>{{ setting('contact_address') }}</p>
                    <p>{{ setting('contact_city') }}, {{ setting('contact_postal_code') }}</p>
                    <p>{{ setting('contact_country') }}</p>
                </div>
            </div>
            
            <div class="info-item">
                <i class="bi bi-clock-fill"></i>
                <div>
                    <strong>Business Hours</strong>
                    <p>{{ setting('hours_days') }}</p>
                    <p>{{ setting('hours_open') }} - {{ setting('hours_close') }}</p>
                </div>
            </div>
            
            <!-- Social Links -->
            <div class="social-section">
                <strong>Follow Us</strong>
                <x-social-links iconSize="2rem" />
            </div>
        </div>
        
        <!-- Map -->
        @if(setting('contact_map_embed_url'))
            <div class="map-section">
                <iframe 
                    src="{{ setting('contact_map_embed_url') }}" 
                    width="100%" 
                    height="450" 
                    style="border:0; border-radius: 10px;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        @endif
    </div>
</div>
@endsection
```

---

## 🚀 Quick Reference

| Setting Key | Example Value | Usage |
|------------|---------------|-------|
| `site_name` | "Daiyaa Restaurant" | `{{ setting('site_name') }}` |
| `site_logo` | "/storage/logo.png" | `<img src="{{ setting('site_logo') }}">` |
| `contact_phone` | "+94 55 223 4567" | `{{ setting('contact_phone') }}` |
| `contact_whatsapp` | "+94552234567" | WhatsApp link |
| `social_facebook` | "https://facebook.com/..." | Social links |
| `feature_online_ordering` | "1" or "0" | `@if(setting('feature_online_ordering') == '1')` |
| `delivery_minimum_order` | "500" | Minimum order amount |
| `seo_google_analytics_id` | "G-XXXXXXXXXX" | Analytics tracking |

---

## 🎓 Need Help?

- Check `/admin/settings` to see all available settings
- All settings are documented in `SETTINGS_USAGE.md`
- Settings are grouped by category for easy management
- Use the `setting('key', 'default')` helper function everywhere

---

**Your website is now fully dynamic! Update settings from the admin panel without touching code. 🎉**


