<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;


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

Route::get('/redirect',[HomeController::class,'redirect'])->middleware('auth');


Route::get('/category',[AdminController::class,'getCategory'])->name('admin.category');
Route::post('/admin/add-category', [AdminController::class, 'addCategory'])->name('admin.addCategory');
Route::get('/admin/delete-Category{id}', [AdminController::class, 'deleteCategory'])->name('admin.deleteCategory');

Route::get('/edit-category/{id}', [AdminController::class, 'editCategory'])->name('admin.editCategory');

Route::post('/admin/update-category/{id}', [AdminController::class, 'updateCategory'])->name('admin.updateCategory');

Route::get('/view_product',[ProductController::class,'viewProduct'])->name('view_product');
Route::get('/add_product',[ProductController::class,'addProductPage']);
Route::post('/add_product',[ProductController::class,'addProduct']);

Route::get('/delete_product/{id}', [ProductController::class, 'destroy'])->name('delete.product');

Route::get('/edit_product/{id}', [ProductController::class, 'editProduct'])->name('edit.product');
Route::post('/edit_product/{id}', [ProductController::class, 'updateProduct'])->name('update.product');


Route::get('/show_product/{id}', [ProductController::class, 'showProduct'])->name('show.product');
