<?php

use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'))->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->middleware('throttle:5,1');

    Route::get('/login', [SessionsController::class, 'create'])
        ->name('login');

    Route::post('/login', [SessionsController::class, 'store'])
        ->middleware('throttle:5,1');
});

Route::post('/logout', [SessionsController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');