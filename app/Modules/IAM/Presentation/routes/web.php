<?php

use App\Http\Middleware\AuthAccount\AuthAccountMiddleware;
use App\Modules\IAM\Presentation\Controllers\AuthController;
use App\Modules\IAM\Presentation\Controllers\PermissionGroupController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')
    ->group(function () {
        Route::controller(AuthController::class)
            ->group(function () {
                Route::match(['GET', 'POST'], 'login', 'login')->name('login');
                Route::match(['GET', 'POST'], 'register', 'register')->name('auth.register');
                Route::match(['GET', 'POST'], 'forgot-password', 'forgotPassword')->name('auth.forgot-password');
                Route::match(['GET', 'POST'], 'reset-password/{token}', 'resetPassword')->name('password.reset');
            });
    });

Route::middleware(['auth', AuthAccountMiddleware::class])
    ->group(function () {
        Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

        Route::controller(PermissionGroupController::class)
            ->prefix('permission-groups')
            ->name('permission-groups.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::match(['GET', 'POST'], '/add', 'add')->name('add');
                Route::match(['GET', 'POST'], '/edit/{id}', 'edit')->name('edit');
                Route::get('/delete/{id}', 'delete')->name('delete');
            });
    });
