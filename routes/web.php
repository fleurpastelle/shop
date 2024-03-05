<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth; // Tambahkan use statement untuk Auth

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Define routes for different parts of the application

// Route to redirect to the index page of products when accessing the root URL
Route::get('/', function () {
    return redirect()->route('index_product');
});

// Authentication routes for login, registration, password reset, etc.
Auth::routes();

// Route to display the index of products
Route::get('/product', [ProductController::class, 'index_product'])->name('index_product');

// Group of routes accessible only to admin users, including product creation, editing, updating, and deletion
Route::middleware(['admin'])->group(function () {
    Route::get('/product/create', [ProductController::class, 'create_product'])->name('create_product');
    Route::post('/product/create', [ProductController::class, 'store_product'])->name('store_product');
    Route::get('/product/{product}/edit', [ProductController::class, 'edit_product'])->name('edit_product');
    Route::patch('/product/{product}/update', [ProductController::class, 'update_product'])->name('update_product');
    Route::delete('/product/{product}', [ProductController::class, 'delete_product'])->name('delete_product');
    Route::post('/order/{order}/confirm', [OrderController::class,'confirm_payment'])->name('confirm_payment');
});

// Group of routes accessible only to authenticated users, including product details viewing and adding to cart
Route::middleware(['auth'])->group(function () {
    Route::post('/cart/{product}', [CartController::class, 'add_to_cart'])->name('add_to_cart');
    // Routes for displaying and managing the cart
    Route::get('/cart', [CartController::class, 'show_cart'])->name('show_cart');
    Route::patch('/cart/{cart}', [CartController::class, 'update_cart'])->name('update_cart');
    Route::delete('/cart/{cart}', [CartController::class, 'delete_cart'])->name('delete_cart');

    // Route for the checkout process
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');

    // Routes for viewing orders and submitting payment receipts
    Route::get('/order', [OrderController::class, 'index_order'])->name('index_order');
    Route::get('/order/{order}', [OrderController::class, 'show_order'])->name('show_order');
    Route::post('/order/{order}/pay', [OrderController::class, 'submit_payment_receipt'])->name('submit_payment_receipt');
    Route::post('/orders/{order}/reject-payment', [OrderController::class, 'rejectPayment'])->name('reject_payment');

    // Route for generating order receipt
    Route::get('/order/nota/{order}', [OrderController::class, 'nota'])->name('nota');
    Route::get('/nota{order}', [OrderController::class, 'NotaTransaksi'])->name('nota');
    
    // Routes for displaying and editing user profile
    Route::get('/profile', [ProfileController::class, 'show_profile'])->name('show_profile');
    Route::post('/profile', [ProfileController::class, 'edit_profile'])->name('edit_profile');
});


// Routes to show one product
Route::get('/product/{product}', [ProductController::class, 'show_product'])->name('show_product');