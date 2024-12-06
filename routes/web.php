<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Authentication and Dashboard routes are protected by the 'auth' middleware
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard route
    Route::get('/dashboard', [VoteController::class, 'dashboard'])->name('dashboard');

    // Voting routes
    Route::get('/vote', [VoteController::class, 'vote'])->name('vote');
    Route::post('/vote', [VoteController::class, 'store'])->name('vote.store');

    // Profile route
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include Breeze routes
require __DIR__ . '/auth.php';
