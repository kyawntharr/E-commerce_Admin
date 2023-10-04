<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'login')->name('login');
Route::post('/', [UserController::class, 'loginForm']);
Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('/', fn() => view('admin.home'))->name('admin.home');
    Route::resource('/cats',CategoryController::class);
    Route::resource('/categories.subcategory',SubCategoryController::class)->shallow();
});


