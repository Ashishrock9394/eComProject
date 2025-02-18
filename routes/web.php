<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;



Route::get('/',[HomeController::class,'index']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.home');
    })->name('dashboard');
});

Route::get('/redirect',[HomeController::class,'redirect'])->middleware('auth')->name('redirect');


Route::get('/category',[AdminController::class,'getCategory'])->name('admin.category');
Route::post('/admin/add-category', [AdminController::class, 'addCategory'])->name('admin.addCategory');
Route::get('/admin/delete-Category{id}', [AdminController::class, 'deleteCategory'])->name('admin.deleteCategory');

Route::get('/edit-category/{id}', [AdminController::class, 'editCategory'])->name('admin.editCategory');

Route::post('/admin/update-category/{id}', [AdminController::class, 'updateCategory'])->name('admin.updateCategory');


Route::get('/show-order',[AdminController::class,'showOrder'])->name('show.order');

Route::put('/orders/{orderId}/status', [AdminController::class, 'updateDeliveryStatus'])->name('orders.updateStatus');










Route::get('/view_product',[ProductController::class,'viewProduct'])->name('view_product');
Route::get('/add_product',[ProductController::class,'addProductPage']);
Route::post('/add_product',[ProductController::class,'addProduct']);

Route::get('/delete_product/{id}', [ProductController::class, 'destroy'])->name('delete.product');

Route::get('/edit_product/{id}', [ProductController::class, 'editProduct'])->name('edit.product');
Route::post('/edit_product/{id}', [ProductController::class, 'updateProduct'])->name('update.product');


Route::get('/show_product/{id}', [HomeController::class, 'showProduct'])->name('show.product');


Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');


Route::get('/checkout', [OrderController::class, 'paymentPage'])->name('user.order');
Route::post('/checkout/place-order', [OrderController::class, 'placeOrder'])->name('checkout.placeOrder');

Route::get('/pay', [PaymentController::class, 'showPaymentPage']);


Route::post('/stripe', [PaymentController::class, 'stripePost'])->name('stripe.post');




