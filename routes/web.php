<?php

use App\Http\Controllers\ShopController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

// Redirect root to shop
Route::get('/', function () {
    return redirect('/shop');
});

// Authentication Routes (provided by Breeze)
require __DIR__ . '/auth.php';

// Shop Routes (Public)
Route::prefix('shop')->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('shop.index');
    Route::get('/category/{categoryId?}', [ShopController::class, 'category'])->name('shop.category');
    Route::get('/product/{id}', [ShopController::class, 'product'])->name('shop.product');
    Route::get('/search', [ShopController::class, 'search'])->name('shop.search');

    // Cart and Checkout
    Route::get('/cart', [CartController::class, 'index'])->name('shop.cart');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    Route::middleware('auth')->group(function () {
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('shop.checkout');
        Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
        Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
        Route::get('/profile', [ShopController::class, 'profile'])->name('shop.profile');
    });
});

// Public Policy Pages
Route::view('/privacy-policy', 'shop.privacy')->name('policy.privacy');
Route::view('/terms-of-service', 'shop.terms')->name('policy.terms');
Route::view('/cookie-policy', 'shop.cookies')->name('policy.cookies');

// Public Support Pages
Route::view('/support-info', 'shop.support')->name('support.info');
Route::view('/returns-policy', 'shop.returns')->name('support.returns');

// User Profile Routes (provided by Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Dashboard Routes
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/my-orders', [UserDashboardController::class, 'orders'])->name('user.orders');
    Route::get('/my-profile', [UserDashboardController::class, 'profile'])->name('user.profile');
    Route::post('/orders/{order}/cancel', [UserDashboardController::class, 'cancelOrder'])->name('user.orders.cancel');
});

// Admin Routes (requires admin authentication)
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', function () {
        return redirect('/admin/dashboard');
    });

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // User Management
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');

    // Category Management
    Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::put('/categories/{category}', [AdminController::class, 'updateCategory'])->name('admin.categories.update');
    Route::delete('/categories/{category}', [AdminController::class, 'destroyCategory'])->name('admin.categories.destroy');

    // Product Management
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
    Route::get('/products/{product}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::put('/products/{product}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/products/{product}', [AdminController::class, 'destroyProduct'])->name('admin.products.destroy');

    // Slider Management
    Route::get('/sliders', [AdminController::class, 'sliders'])->name('admin.sliders');
    Route::post('/sliders', [AdminController::class, 'storeSlider'])->name('admin.sliders.store');
    Route::put('/sliders/{slider}', [AdminController::class, 'updateSlider'])->name('admin.sliders.update');
    Route::delete('/sliders/{slider}', [AdminController::class, 'destroySlider'])->name('admin.sliders.destroy');


    // Orders
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::patch('/orders/{order}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.updateStatus');
    Route::delete('/orders/{order}', [AdminController::class, 'destroyOrder'])->name('admin.orders.destroy');
});

// Admin Login (separate from regular login)
Route::get('image.png/admin/login', function () {
    return view('admin.login');
})->name('admin.login');
