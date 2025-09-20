<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

// Public routes
Route::get('/poems', function () {
    return view('poems.index');
})->name('poems.index');

Route::get('/poets', function () {
    return view('poets.index');
})->name('poets.index');

Route::get('/categories', function () {
    return view('categories.index');
})->name('categories.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Poem management routes
    Route::get('/poems/create', function () {
        return view('poems.create');
    })->name('poems.create');
});

require __DIR__.'/auth.php';
