# Common Navbar Integration

## Overview
The navigation bar has been unified across the entire website, providing a consistent user experience whether visitors are on the home page or using the food delivery system.

## Implementation

### Shared Component
Created a reusable navbar component at:
- **Location**: `resources/views/components/navbar.blade.php`

This component is now included in:
- ✅ **Home Page**: `welcome.blade.php`
- ✅ **Food Delivery Pages**: `layouts/app.blade.php`
- ⚠️ **Admin Panel**: Uses separate sidebar navigation (by design)

## Navigation Structure

### Common Links (All Users)
1. **Home** - Main landing page
2. **About** - Scrolls to about section
3. **Order Online** - Opens the menu for ordering
4. **Gallery** - Photo gallery section
5. **Contact** - Contact information

### For Guest Users (Not Logged In)
6. **Login** - Access to login page (with person icon)
7. **Sign Up** - Registration page (styled button in gold)

### For Authenticated Customers
6. **My Orders** - View order history
7. **Cart** - Shopping cart with live item count badge
8. **Logout** - Sign out (with icon)

### For Admin Users
6. **My Orders**
7. **Cart** (with badge)
8. **Admin** - Quick access to admin dashboard
9. **Logout**

## Features

### 1. Live Cart Counter
- Red badge appears on cart icon showing number of items
- Updates in real-time when items are added
- Only visible when cart has items

### 2. Responsive Design
- Desktop: Full horizontal menu
- Mobile: Hamburger menu (☰)
  - Toggles to close icon (✕) when open
  - Full-screen dropdown
  - Auto-closes when link is clicked
  - Closes when clicking outside

### 3. Scroll Effect
- Navbar becomes more compact on scroll
- Shadow effect appears for depth
- Smooth transitions

### 4. Smart Routing
- Home page sections use anchor links (#about, #gallery, etc.)
- Food delivery pages use full routes
- Works correctly from any page

## Styling

### Colors
- Background: Dark with blur effect
- Text: White/Gold theme
- Active/Hover: Gold accent
- Cart Badge: Red background

### Typography
- Logo: Playfair Display (2rem)
- Links: Poppins (500 weight)
- Responsive scaling on mobile

### Effects
- Underline animation on hover
- Smooth color transitions
- Mobile menu slide effect

## Mobile Behavior

### Hamburger Menu
```
☰ (closed) → ✕ (opened)
```

### Auto-Close Events
- Clicking any navigation link
- Clicking outside the menu
- Selecting a page section

## Technical Details

### JavaScript Features
1. **Scroll Detection**: Adds 'scrolled' class at 50px
2. **Mobile Toggle**: Manages menu open/close state
3. **Click Outside**: Closes menu when clicking elsewhere
4. **Smooth Scrolling**: Animates to anchor sections

### Authentication Check
Uses Laravel's `@auth` directive to show/hide links:
```blade
@auth
    <!-- Authenticated user links -->
@else
    <!-- Guest links -->
@endauth
```

### Cart Count
Dynamically loads from user model:
```blade
@if(auth()->user()->cart_count > 0)
    <span class="badge">{{ auth()->user()->cart_count }}</span>
@endif
```

## Benefits

✅ **Consistency**: Same navigation everywhere
✅ **DRY Principle**: Single source of truth
✅ **Easy Updates**: Change once, apply everywhere
✅ **Better UX**: Familiar navigation across all pages
✅ **Maintenance**: Simpler to maintain and update
✅ **Mobile-First**: Fully responsive design

## Admin Panel Note

The admin panel (`/admin/*` routes) intentionally uses a **different layout** with:
- Sidebar navigation (better for admin tasks)
- Different color scheme
- Additional admin-specific features

This is by design as admin interfaces have different UX requirements.

## Usage

To use the navbar in any new Blade template:

```blade
@include('components.navbar')
```

That's it! The navbar will automatically:
- Show correct links based on authentication
- Display cart count if user is logged in
- Work on both desktop and mobile
- Maintain consistent styling

## Maintenance

### To Update Navigation Items
Edit: `resources/views/components/navbar.blade.php`

### To Change Styling
Modify the `<style>` block in the same file

### To Add New Links
Add within the `<ul class="nav-links">` element

Remember: Changes apply to the entire website!

