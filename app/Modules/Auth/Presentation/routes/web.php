<?php

use App\Modules\Auth\Presentation\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')
    ->controller(AuthController::class)
    ->group(function () {
        Route::match(['GET', 'POST'], 'login', 'login')->name('login');
        Route::match(['GET', 'POST'], 'register', 'register')->name('auth.register');
        Route::match(['GET', 'POST'], 'forgot-password', 'forgotPassword')->name('auth.forgot-password');
        Route::match(['GET', 'POST'], 'reset-password/{token}', 'resetPassword')->name('password.reset');
    });

Route::middleware('auth')
    ->controller(AuthController::class)
    ->group(function () {
        Route::get('logout', 'logout')->name('auth.logout');
    });
