<?php
use App\Http\Controllers\AdminAuth\AuthenticatedSessionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;


Route::get('/',  [HomeController::class, 'home']);
Route::get('/home',  [HomeController::class, 'login_home'])->middleware(['auth', 'verified'])->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
require __DIR__.'/auth.php';

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth:admin', 'verified'])
    ->name('admin.dashboard');

require __DIR__.'/adminauth.php';

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');


// HomeController
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::middleware('auth')->group(function () {
    Route::get('/add_cart/{id}', [HomeController::class, 'add_cart'])->name('add_cart');
    Route::post('/add_cart/{id}', [HomeController::class, 'add_cart'])->name('add_cart');

    Route::get('/mycart', [HomeController::class, 'mycart'])->name('mycart');
    Route::get('/view_products/{id}', [HomeController::class, 'view_products'])->name('view_products');
    Route::post('/delete-cart-item/{id}', [HomeController::class, 'deleteCartItem'])->name('delete_cart_item');
    Route::post('/update-quantity/{cartId}', [HomeController::class, 'updateQuantity'])->name('update_quantity');
    Route::post('/checkout', [HomeController::class, 'checkout'])->name('checkout');
    Route::get('/checkout', [HomeController::class, 'showCart'])->name('showCart');

});

//AdminController
Route::get('view_category', [AdminController::class, 'view_category'])->middleware(['auth:admin', 'verified']);
Route::post('add_category', [AdminController::class, 'add_category'])->middleware(['auth:admin', 'verified']);
Route::get('delete_category/{id}', [AdminController::class, 'delete_category'])->middleware(['auth:admin', 'verified']);
Route::get('edit_category/{id}', [AdminController::class, 'edit_category'])->middleware(['auth:admin', 'verified']);
Route::POST('update_category/{id}', [AdminController::class, 'update_category'])->middleware(['auth:admin', 'verified']);
Route::get('add_product', [AdminController::class, 'add_product'])->middleware(['auth:admin', 'verified']);
Route::POST('upload_product', [AdminController::class, 'upload_product'])->middleware(['auth:admin', 'verified']);
Route::get('view_product', [AdminController::class, 'view_product'])->middleware(['auth:admin', 'verified']);
Route::get('delete_product/{id}', [AdminController::class, 'delete_product'])->middleware(['auth:admin', 'verified']);
Route::get('update_product/{id}', [AdminController::class, 'update_product'])->middleware(['auth:admin', 'verified']);
Route::POST('edit_product/{id}', [AdminController::class, 'edit_product'])->middleware(['auth:admin', 'verified']);
Route::get('product_search', [AdminController::class, 'product_search'])->middleware(['auth:admin', 'verified']);
Route::get('view_order', [AdminController::class, 'view_order'])->middleware(['auth:admin', 'verified']);
Route::get('out_for_delivery/{id}', [AdminController::class, 'out_for_delivery'])->middleware(['auth:admin', 'verified']);
Route::get('delivered/{id}', [AdminController::class, 'delivered'])->middleware(['auth:admin', 'verified']);
Route::get('/customer_data', [AdminController::class, 'customer_data'])->middleware(['auth:admin', 'verified']);







