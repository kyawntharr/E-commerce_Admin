<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'login')->name('login');
Route::post('/', [UserController::class, 'loginForm']);
Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('/', fn() => view('admin.home'))->name('admin.home');
    Route::resource('/cats', CategoryController::class);
    Route::resource('/categories.subcategory', SubCategoryController::class)->shallow();
    Route::resource('/tags', TagController::class);
    Route::resource('/products', ProductController::class);
    Route::get('/orders',[OrderController::class,'allorder'])->name('all-order');
    Route::get('/orderitems/{id}',[OrderItemController::class,'orderItemById'])->name('orderitembyId');
    Route::post('/order/{id}',[OrderController::class,'updateStatus'])->name('order.status');
});
