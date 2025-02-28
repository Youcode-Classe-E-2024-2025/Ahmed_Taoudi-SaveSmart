
<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('register', [RegisterController::class, 'index'])
    ->name('register');

Route::post('register', [RegisterController::class, 'register']);

Route::get('login', [LoginController::class, 'index'])
    ->name('login');

Route::post('login', [LoginController::class, 'login']);

Route::get('logout', [LoginController::class, 'logout'])
    ->name('logout');
