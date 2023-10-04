<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [ApiController::class, 'login']);

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/me', [ApiController::class, 'me']);
});
