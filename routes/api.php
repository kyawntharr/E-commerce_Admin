<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [ApiController::class, 'login']);
Route::get('/register', [ApiController::class, 'register']);
Route::get('/cats', [ApiController::class, 'cats']);
Route::get('/{id}/subcats', [ApiController::class, 'subcats']);
Route::get('/tags', [ApiController::class,'tags']);
Route::get('/products', [ApiController::class,'products']);
Route::get('/pbc/{id}', [ApiController::class,'productByCategory']);
Route::get('/pbt/{id}', [ApiController::class,'productByTag']);

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/me', [ApiController::class, 'me']);
});
