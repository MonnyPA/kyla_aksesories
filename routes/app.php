<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

Route::middleware(['role:admin|owner'])->group(function () {

    Route::resource('products', ProductController::class);
    Route::get('/products/active/{id}', [ProductController::class, 'markAsActive'])->name('products.active');
    Route::get('/products/nonactive/{id}', [ProductController::class, 'markAsNonactive'])->name('products.nonactive');
    Route::resource('orders', OrderController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource('roles', RoleController::class);

    Route::resource('users', UserController::class);

    Route::get('/dashboard/daily-revenue', [DashboardController::class, 'dailyRevenue']);

});

Route::middleware(['role:admin|cashier_osm|cashier_kd'])->group(function () {
    Route::get('/listproduct', [MenuController::class, 'index'])->name('listproduct');
    Route::get('/cart', [MenuController::class, 'cart'])->name('cart');

    Route::post('/cart/add', [MenuController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update', [MenuController::class, 'updateCart'])->name('cart.update');
    Route::post('/cart/remove', [MenuController::class, 'removeCart'])->name('cart.remove');
    Route::get('/cart/clear', [MenuController::class, 'clearCart'])->name('cart.clear');

    Route::get('/checkout', [MenuController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/store', [MenuController::class, 'storeOrder'])->name('checkout.store');
});

Route::middleware(['role:admin|cashier_osm|cashier_kd|owner'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/daily-orders', [DashboardController::class, 'dailyOrders']);

    Route::get('/dashboard/top-products', [DashboardController::class, 'dashboard'])->name('topProducts');
});

// Route::get('/', function () {
//     return redirect()->route('dashboard');});

// Route::get('/dashboard/top-products', [DashboardController::class, 'topProducts']);
