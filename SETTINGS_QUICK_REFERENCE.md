# ⚡ Settings Quick Reference Card

## 🎯 Most Used Settings

### Website Basics
```blade
{{ setting('site_name') }}                    <!-- Daiyaa Restaurant -->
{{ setting('site_tagline') }}                 <!-- Authentic Sri Lankan Cuisine -->
{{ setting('site_description') }}             <!-- Full description -->
{{ setting('site_logo') }}                    <!-- /storage/settings/logo.png -->
{{ setting('site_favicon') }}                 <!-- /storage/settings/favicon.ico -->
{{ setting('site_footer_text') }}             <!-- © 2025 Daiyaa... -->
```

### Contact Info
```blade
{{ setting('contact_phone') }}                <!-- +94 55 223 4567 -->
{{ setting('contact_phone_secondary') }}      <!-- +94 77 123 4567 -->
{{ setting('contact_email') }}                <!-- info@daiyaa.lk -->
{{ setting('contact_whatsapp') }}             <!-- +94552234567 -->
{{ setting('contact_address') }}              <!-- Full address -->
{{ setting('contact_city') }}                 <!-- Wellawaya -->
```

### Business Hours
```blade
{{ setting('hours_open') }}                   <!-- 10:00 AM -->
{{ setting('hours_close') }}                  <!-- 11:00 PM -->
{{ setting('hours_days') }}                   <!-- Monday - Sunday -->
{{ setting('hours_special_note') }}           <!-- Open all public holidays -->
```

### Social Media
```blade
{{ setting('social_facebook') }}              <!-- https://facebook.com/... -->
{{ setting('social_instagram') }}             <!-- https://instagram.com/... -->
{{ setting('social_twitter') }}               <!-- https://twitter.com/... -->
{{ setting('social_youtube') }}               <!-- https://youtube.com/... -->
{{ setting('social_tiktok') }}                <!-- https://tiktok.com/... -->
<x-social-links />                            <!-- Shows all social links -->
```

### Currency & Language
```blade
{{ setting('site_currency') }}                <!-- LKR -->
{{ setting('site_currency_symbol') }}         <!-- Rs -->
{{ setting('site_language') }}                <!-- en -->
```

### SEO
```blade
{{ setting('seo_title') }}                    <!-- SEO meta title -->
{{ setting('seo_description') }}              <!-- SEO meta description -->
{{ setting('seo_keywords') }}                 <!-- Keywords -->
{{ setting('seo_google_analytics_id') }}      <!-- G-XXXXXXXXXX -->
```

### Delivery
```blade
{{ setting('delivery_minimum_order') }}       <!-- 500 -->
{{ setting('delivery_fee') }}                 <!-- 150 -->
{{ setting('delivery_free_above') }}          <!-- 2000 -->
{{ setting('delivery_estimated_time') }}      <!-- 30-45 minutes -->
```

### Feature Flags (Check if enabled)
```blade
@if(setting('feature_online_ordering') == '1')
    <!-- Show ordering button -->
@endif

@if(setting('feature_promotions') == '1')
    <!-- Show promotion popup -->
@endif

@if(setting('feature_table_reservation') == '1')
    <!-- Show reservation form -->
@endif

@if(setting('maintenance_mode') == '1')
    <!-- Show maintenance page -->
@endif
```

---

## 📱 Common Patterns

### Phone Link
```blade
<a href="tel:{{ setting('contact_phone') }}">
    Call {{ setting('contact_phone') }}
</a>
```

### Email Link
```blade
<a href="mailto:{{ setting('contact_email') }}">
    {{ setting('contact_email') }}
</a>
```

### WhatsApp Link
```blade
<a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('contact_whatsapp')) }}" 
   target="_blank">
    <i class="bi bi-whatsapp"></i> Chat on WhatsApp
</a>
```

### Google Maps Link
```blade
<a href="https://www.google.com/maps?q={{ setting('contact_map_latitude') }},{{ setting('contact_map_longitude') }}" 
   target="_blank">
    Get Directions
</a>
```

### Price with Currency
```blade
{{ setting('site_currency_symbol') }}{{ number_format($price, 2) }}
<!-- Output: Rs1,500.00 -->
```

### Logo Display
```blade
@if(setting('site_logo'))
    <img src="{{ setting('site_logo') }}" alt="{{ setting('site_name') }}">
@else
    <h1>{{ setting('site_name') }}</h1>
@endif
```

### Social Links Component
```blade
<!-- Simple -->
<x-social-links />

<!-- Custom size -->
<x-social-links iconSize="2rem" />

<!-- Custom class -->
<x-social-links class="footer-social" iconSize="1.8rem" />
```

---

## 🎨 Complete Header Example

```blade
<!DOCTYPE html>
<html lang="{{ setting('site_language', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ setting('seo_title', setting('site_name')) }}</title>
    <meta name="description" content="{{ setting('seo_description') }}">
    <meta name="keywords" content="{{ setting('seo_keywords') }}">
    
    @if(setting('site_favicon'))
        <link rel="icon" href="{{ setting('site_favicon') }}">
    @endif
</head>
```

---

## 📧 Email Example

```php
Mail::send('emails.order', $data, function($message) {
    $message->from(
        setting('email_from_address'),
        setting('email_from_name')
    );
    $message->to($customer->email);
    $message->subject('Order Confirmation - ' . setting('site_name'));
});
```

---

## 🔄 Cache Management

```php
use App\Models\Setting;

// Clear single setting cache
Cache::forget('setting_site_name');

// Clear all settings cache
Setting::clearCache();

// Or via Artisan
php artisan cache:clear
```

---

## 🎯 Admin Panel

**URL:** `/admin/settings`

**Tabs:**
1. General - Website basics
2. Contact - Contact information
3. Hours - Business hours
4. Social - Social media
5. SEO - Search optimization
6. Delivery - Delivery options
7. Email - Email settings
8. Features - Feature toggles

---

## 💡 Pro Tips

1. **Always use defaults:**
   ```blade
   {{ setting('site_name', 'Fallback Name') }}
   ```

2. **Check before displaying:**
   ```blade
   @if(setting('social_facebook'))
       <a href="{{ setting('social_facebook') }}">Facebook</a>
   @endif
   ```

3. **Cache is automatic:**
   - Settings are cached on first access
   - Cache cleared on update
   - No manual intervention needed

4. **Feature flags:**
   ```blade
   @if(setting('feature_online_ordering') == '1')
       <!-- Enabled -->
   @endif
   ```

5. **Images return paths:**
   ```blade
   <img src="{{ setting('site_logo') }}" alt="Logo">
   <!-- Path: /storage/settings/logo.png -->
   ```

---

## 🚀 All Setting Keys

### General (9)
- `site_name`
- `site_tagline`
- `site_description`
- `site_logo`
- `site_favicon`
- `site_footer_text`
- `site_currency`
- `site_currency_symbol`
- `site_language`

### Contact (12)
- `contact_phone`
- `contact_phone_secondary`
- `contact_email`
- `contact_email_support`
- `contact_whatsapp`
- `contact_address`
- `contact_city`
- `contact_postal_code`
- `contact_country`
- `contact_map_latitude`
- `contact_map_longitude`
- `contact_map_embed_url`

### Hours (4)
- `hours_open`
- `hours_close`
- `hours_days`
- `hours_special_note`

### Social (11)
- `social_facebook`
- `social_instagram`
- `social_twitter`
- `social_youtube`
- `social_tiktok`
- `social_linkedin`
- `social_pinterest`
- `social_telegram`
- `social_snapchat`
- `social_tripadvisor`
- `social_yelp`

### SEO (7)
- `seo_title`
- `seo_description`
- `seo_keywords`
- `seo_og_image`
- `seo_google_analytics_id`
- `seo_google_tag_manager_id`
- `seo_facebook_pixel_id`

### Delivery (7)
- `delivery_minimum_order`
- `delivery_fee`
- `delivery_free_above`
- `delivery_radius`
- `delivery_estimated_time`
- `payment_cash_on_delivery`
- `payment_online_enabled`

### Features (7)
- `feature_online_ordering`
- `feature_promotions`
- `feature_table_reservation`
- `feature_customer_reviews`
- `feature_newsletter`
- `feature_loyalty_program`
- `maintenance_mode`

### Email (5)
- `email_from_name`
- `email_from_address`
- `email_order_confirmation`
- `email_admin_notifications`
- `email_admin_address`

**Total: 70+ Settings!** 🎉

---

## 📖 Full Documentation

See **DYNAMIC_SETTINGS_GUIDE.md** for complete examples and advanced usage.


