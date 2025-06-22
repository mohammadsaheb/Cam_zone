<?php

use App\Models\User;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserBookingController;
use App\Http\Controllers\CartController;





// Public routes

Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication routes (added by Breeze)
require __DIR__.'/auth.php';



// Admin routes - protected by auth and admin middleware
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Productsa
    Route::resource('products', ProductController::class);
    Route::delete('product-images/{productImage}', [ProductImageController::class, 'destroy'])->name('product-images.destroy');
    
    // Users
    Route::resource('users', UserController::class);
    
    // Reviews
    Route::resource('reviews', ReviewController::class);
    
    // Categories
    Route::resource('categories', CategoryController::class);
    
    // Coupons
    Route::resource('coupons', CouponController::class);
    
    // Orders
    Route::resource('orders', OrderController::class);
    
    // Bookings
    Route::resource('bookings', BookingController::class);
});
// User booking routes

// Add these routes to your routes/web.php file









// مسارات الحجز
Route::middleware(['auth'])->group(function () {
    Route::get('/bookings', [App\Http\Controllers\UserBookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [App\Http\Controllers\UserBookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/confirmation/{id}', [App\Http\Controllers\UserBookingController::class, 'confirmation'])->name('bookings.confirmation');
});

// API route for fetching booked slots (no auth required for this one)
Route::get('/api/booking/booked-slots', [App\Http\Controllers\UserBookingController::class, 'getBookedSlots']);


// Public routes (in routes/web.php)
Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');

// Cart Routes




Route::middleware(['auth'])->group(function () {
    // View cart
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'viewCart'])->name('cart.view');
    
    // Add to cart (from product detail page) - Making sure it's a GET route
    Route::get('/cart/add/{productId}', [App\Http\Controllers\CartController::class, 'addToCart'])->name('cart.add');
    
    // Update cart item quantity
    Route::post('/cart/update/{cartItemId}', [App\Http\Controllers\CartController::class, 'updateCart'])->name('cart.update');
    
    // Remove from cart
    Route::post('/cart/remove/{cartItemId}', [App\Http\Controllers\CartController::class, 'removeFromCart'])->name('cart.remove');
});
Route::middleware(['auth'])->group(function () {
    // Checkout page
    Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
    
    // Place order
    Route::post('/checkout/place-order', [App\Http\Controllers\CheckoutController::class, 'placeOrder'])->name('checkout.place-order');
    
    // Order confirmation
    Route::get('/checkout/confirmation/{orderId}', [App\Http\Controllers\CheckoutController::class, 'confirmation'])->name('checkout.confirmation');
});

Route::get('/shop', [App\Http\Controllers\ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/product/{id}', [App\Http\Controllers\ShopController::class, 'show'])->name('shop.product.show');