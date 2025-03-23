<?php

use App\Modules\Auth\Presentation\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')
    ->controller(AuthController::class)
    ->group(function () {
        Route::match(['GET', 'POST'], 'login', 'login')->name('login');
        Route::match(['GET', 'POST'], 'register', 'register')->name('auth.register');
    });

Route::middleware('auth')
    ->controller(AuthController::class)
    ->group(function () {
        Route::get('logout', 'logout')->name('auth.logout');
    });
