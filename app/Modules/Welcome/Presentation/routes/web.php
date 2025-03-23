<?php

use App\Modules\Welcome\Presentation\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('welcome', [WelcomeController::class, 'index'])->name('welcome');
