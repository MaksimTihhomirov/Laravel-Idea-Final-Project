<?php

use App\Http\Controllers\IdeaController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\StepController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IdeaController::class, 'index'])->name('home');

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

Route::middleware('auth')->group(function () {
    Route::get('/ideas', [IdeaController::class, 'index'])
        ->name('ideas.index');

    Route::post('/ideas', [IdeaController::class, 'store'])
        ->name('ideas.store');

    Route::get('/ideas/{idea}', [IdeaController::class, 'show'])
        ->name('ideas.show')
        ->can('view', 'idea');

    Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy'])
        ->name('ideas.destroy')
        ->can('delete', 'idea');

    Route::patch('/steps/{step}', [StepController::class, 'update'])
        ->name('steps.update');

    Route::post('/logout', [SessionsController::class, 'destroy'])
        ->name('logout');
});