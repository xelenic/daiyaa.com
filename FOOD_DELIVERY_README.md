# Daiyaa Restaurant - Online Food Delivery System

A complete online food delivery system built with Laravel featuring customer ordering and admin management.

## Features Implemented

### Customer Features
- **User Registration & Authentication** - Custom authentication system (no build tools)
- **Menu Browsing** - View menu items by categories with search functionality
- **Shopping Cart** - Add/remove items, adjust quantities
- **Checkout** - Place orders with delivery address
- **Order Tracking** - View order history and track order status in real-time
- **Cash on Delivery** - Payment method supported

### Admin Features
- **Admin Dashboard** - Overview of orders, revenue, and statistics
- **Menu Management** - Create, edit, delete menu items
- **Order Management** - View all orders and update order status
- **Separate Admin Panel** - Dedicated interface for restaurant management

### Design
- **Beautiful UI** - Gold and dark theme matching the original website
- **Responsive** - Works on desktop and mobile devices
- **No Build Tools** - Uses CDN-based libraries (no npm required)

## Database Structure

### Tables Created
- `users` - Customer and admin accounts
- `categories` - Food categories
- `menu_items` - Restaurant menu
- `cart_items` - Shopping cart items
- `orders` - Customer orders
- `order_items` - Items in each order

## Default Accounts

### Admin Account
- **Email**: admin@daiyaa.lk
- **Password**: admin123

### Test Customer Account
- **Email**: customer@test.com
- **Password**: customer123

## Initial Data

The system is pre-loaded with:
- 6 categories (Rice & Curry, Kottu & Roti, Hoppers, Seafood, Special Dishes, Desserts)
- 6 menu items from the original welcome page

## Order Status Flow

Orders follow this workflow:
1. **Pending** - Order placed, waiting for confirmation
2. **Confirmed** - Restaurant confirmed the order
3. **Preparing** - Food is being prepared
4. **Out for Delivery** - Order is on the way
5. **Delivered** - Order completed
6. **Cancelled** - Order cancelled (can be set at any time)

## Routes

### Public Routes
- `/` - Homepage
- `/menu` - Browse menu
- `/login` - Login page
- `/register` - Registration page

### Customer Routes (Authenticated)
- `/cart` - Shopping cart
- `/checkout` - Checkout page
- `/orders` - Order history
- `/orders/{id}` - Order details

### Admin Routes (Admin only)
- `/admin/dashboard` - Admin dashboard
- `/admin/menu-items` - Manage menu items
- `/admin/orders` - Manage orders

## How to Use

### As a Customer

1. **Register an Account**
   - Go to `/register`
   - Fill in your details including delivery address
   - Submit the form

2. **Browse Menu**
   - Click "Menu" in navigation
   - Filter by category or search for items
   - Adjust quantity and click "Add to Cart"

3. **Checkout**
   - Click cart icon in navigation
   - Review items and adjust quantities if needed
   - Click "Proceed to Checkout"
   - Verify delivery details
   - Place order

4. **Track Orders**
   - Click "My Orders" in navigation
   - View all your orders
   - Click "View Details" to see order status timeline

### As an Admin

1. **Login**
   - Use admin credentials (admin@daiyaa.lk / admin123)
   - You'll be redirected to admin dashboard

2. **Manage Menu Items**
   - Click "Menu Items" in sidebar
   - Add new items with "Add New Item" button
   - Edit or delete existing items
   - Toggle availability status

3. **Manage Orders**
   - Click "Orders" in sidebar
   - Filter orders by status
   - Click "View" to see order details
   - Update order status as it progresses

## Key Features

### Cart System
- Real-time cart count badge
- AJAX-based add to cart (no page reload)
- Quantity controls
- Automatic total calculation

### Order Management
- Unique order numbers (format: DY20250101XXXX)
- Timeline visualization of order status
- Customer and delivery information
- Order item breakdown

### Admin Panel
- Statistics cards with key metrics
- Recent orders table
- Quick status filtering
- Separate admin layout with sidebar navigation

## Technical Details

### No Build Tools
- All CSS is inline in Blade templates
- JavaScript uses vanilla JS (no frameworks)
- External libraries loaded via CDN:
  - Google Fonts (Playfair Display, Poppins)
  - Bootstrap Icons
  
### Authentication
- Custom authentication (not using Laravel Breeze/Jetstream)
- Role-based access control via `is_admin` column
- Protected routes with middleware

### Database
- SQLite database included
- Migrations for all tables
- Seeders for initial data
- Foreign key constraints

### Permissions
- Policies for cart and order authorization
- Admin middleware for admin-only routes
- Users can only access their own carts and orders

## Customization

### Adding More Menu Items
1. Login as admin
2. Go to Menu Items
3. Click "Add New Item"
4. Fill in details (use Unsplash URLs for images)
5. Set category, price, and availability

### Managing Categories
Categories are seeded in the database. To add more:
1. Add to `CategorySeeder.php`
2. Run `php artisan migrate:fresh --seed`

### Changing Theme Colors
Edit the CSS variables in `resources/views/layouts/app.blade.php`:
```css
:root {
    --primary-gold: #D4AF37;  /* Change to your color */
    --dark-bg: #0a0a0a;
    /* ... other colors */
}
```

## Support

The system is fully functional and ready to use. All features have been implemented according to the plan:
- ✅ Custom authentication system
- ✅ Menu browsing with categories
- ✅ Shopping cart functionality
- ✅ Checkout and order placement
- ✅ Order history and tracking
- ✅ Admin dashboard and management
- ✅ Beautiful, responsive design
- ✅ No build tools required

Enjoy your online food delivery system! 🍽️

