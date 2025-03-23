<?php

use App\Modules\Todos\Presentation\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::controller(TodoController::class)
    ->prefix('todos')
    ->name('todos.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::match(['GET', 'POST'], '/add', 'add')->name('add');
        Route::match(['GET', 'POST'], '/edit/{id}', 'edit')->name('edit');
        Route::get('/delete/{id}', 'delete')->name('delete');
    });
