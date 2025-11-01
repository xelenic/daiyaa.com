<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuItemController as AdminMenuItemController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\SettingController;

// Public Routes
Route::get('/', function () {
    // Get all active promotions (without date filtering for now)
    $promotions = \App\Models\Promotion::where('is_active', true)->orderBy('sort_order')->get();
    return view('welcome', compact('promotions'));
})->name('home');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Menu Routes (Public)
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/{slug}', [MenuController::class, 'show'])->name('menu.show');

// Cart Routes (Authenticated)
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{menuItem}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cartItem}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // Order Routes
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Menu Items Management
    Route::resource('menu-items', AdminMenuItemController::class);

    // Orders Management
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');

    // Promotions Management
    Route::resource('promotions', PromotionController::class);
    
    // Settings Management
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index'); // Old combined view
    Route::get('/settings/general', [SettingController::class, 'general'])->name('settings.general');
    Route::get('/settings/contact', [SettingController::class, 'contact'])->name('settings.contact');
    Route::get('/settings/hours', [SettingController::class, 'hours'])->name('settings.hours');
    Route::get('/settings/social', [SettingController::class, 'social'])->name('settings.social');
    Route::get('/settings/seo', [SettingController::class, 'seo'])->name('settings.seo');
    Route::get('/settings/delivery', [SettingController::class, 'delivery'])->name('settings.delivery');
    Route::get('/settings/email', [SettingController::class, 'email'])->name('settings.email');
    Route::get('/settings/features', [SettingController::class, 'features'])->name('settings.features');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
});
