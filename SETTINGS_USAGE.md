# Settings System - Usage Guide

## Overview
The settings system allows you to manage dynamic website configurations from the admin panel without touching code.

## Database Structure

```sql
- id: Primary key
- key: Unique identifier (e.g., 'site_name')
- value: Setting value
- type: Input type (text, textarea, select, toggle, image)
- label: Display label in admin panel
- options: JSON array for select options (optional)
- group: Settings group (general, contact, hours, social, features)
- order: Display order within group
```

## How to Use Settings in Code

### 1. In Blade Templates (.blade.php)

```php
<!-- Get a setting -->
{{ setting('site_name') }}

<!-- Get with default value -->
{{ setting('site_name', 'Default Name') }}

<!-- Examples -->
<title>{{ setting('site_name', 'Daiyaa Restaurant') }}</title>
<p>{{ setting('site_tagline') }}</p>
<p>Call us: {{ setting('contact_phone') }}</p>
```

### 2. In Controllers

```php
use App\Models\Setting;

// Get a setting
$siteName = setting('site_name');

// Or use the model directly
$siteName = Setting::get('site_name', 'Default');

// Set a setting
Setting::set('site_name', 'New Name');
```

### 3. In Routes

```php
Route::get('/', function () {
    $siteName = setting('site_name');
    return view('welcome', compact('siteName'));
});
```

## Available Setting Types

### 1. **text** - Single line text input
```php
[
    'key' => 'site_name',
    'value' => 'Daiyaa Restaurant',
    'type' => 'text',
    'label' => 'Website Name',
    'group' => 'general',
]
```

### 2. **textarea** - Multi-line text input
```php
[
    'key' => 'site_description',
    'value' => 'Long description here...',
    'type' => 'textarea',
    'label' => 'Website Description',
    'group' => 'general',
]
```

### 3. **select** - Dropdown selection
```php
[
    'key' => 'currency',
    'value' => 'LKR',
    'type' => 'select',
    'label' => 'Currency',
    'options' => ['USD' => 'US Dollar', 'LKR' => 'Sri Lankan Rupee'],
    'group' => 'general',
]
```

### 4. **toggle** - On/Off switch
```php
[
    'key' => 'maintenance_mode',
    'value' => '0', // or '1'
    'type' => 'toggle',
    'label' => 'Maintenance Mode',
    'group' => 'features',
]
```

### 5. **image** - File upload
```php
[
    'key' => 'site_logo',
    'value' => '/storage/settings/logo.png',
    'type' => 'image',
    'label' => 'Website Logo',
    'group' => 'general',
]
```

## Setting Groups

- **general** - Site name, logo, tagline, description
- **contact** - Phone, email, address, WhatsApp
- **hours** - Opening hours, days
- **social** - Social media links
- **features** - Feature toggles (online ordering, promotions, etc.)

## How to Add New Settings

### Method 1: Via Database Seeder (Recommended)

Edit `database/seeders/SettingSeeder.php`:

```php
[
    'key' => 'my_new_setting',
    'value' => 'Default Value',
    'type' => 'text',
    'label' => 'My New Setting',
    'group' => 'general',
    'order' => 10,
],
```

Then run:
```bash
php artisan db:seed --class=SettingSeeder
```

### Method 2: Via Admin Panel

1. Login to admin panel
2. Go to "Settings"
3. Note: You cannot add new settings from UI, only edit existing ones

### Method 3: Programmatically

```php
use App\Models\Setting;

Setting::create([
    'key' => 'new_setting',
    'value' => 'value',
    'type' => 'text',
    'label' => 'New Setting',
    'group' => 'general',
    'order' => 1,
]);
```

## Caching

Settings are cached automatically for better performance.

### Clear Settings Cache

```php
use App\Models\Setting;

Setting::clearCache();
```

Or via Artisan:
```bash
php artisan cache:clear
```

## Admin Panel Access

1. Navigate to `/admin/settings`
2. Settings are grouped by category
3. Edit values and click "Update Settings"
4. Changes are instant

## Examples

### Update Contact Information
```php
// In admin panel or code
Setting::set('contact_phone', '+94 77 123 4567');
Setting::set('contact_email', 'info@restaurant.lk');
```

### Check if Feature is Enabled
```php
if (setting('feature_online_ordering') == '1') {
    // Show online ordering button
}
```

### Use in Navigation
```blade
<a href="tel:{{ setting('contact_phone') }}">
    Call: {{ setting('contact_phone') }}
</a>
```

## Best Practices

1. ✅ Always provide default values
2. ✅ Use meaningful key names (snake_case)
3. ✅ Group related settings
4. ✅ Clear cache after bulk updates
5. ❌ Don't store sensitive data (passwords, API keys)
6. ❌ Don't use for frequently changing data

## API

```php
// Get setting
$value = setting('key', 'default');
$value = Setting::get('key', 'default');

// Set setting
Setting::set('key', 'value');

// Create/Update
Setting::updateOrCreate(['key' => 'key'], ['value' => 'new value']);

// Clear cache
Setting::clearCache();
```

## Troubleshooting

**Settings not updating?**
- Clear cache: `php artisan cache:clear`
- Check file permissions on storage folder

**Setting not found?**
- Run seeder: `php artisan db:seed --class=SettingSeeder`
- Check database: `select * from settings;`

**Images not uploading?**
- Check storage link: `php artisan storage:link`
- Verify folder permissions: `storage/app/public/settings`


