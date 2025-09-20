<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminDashboardController;
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

// Dashboard routes with role-based redirection
Route::get('/dashboard', function () {
    $user = auth()->user();
    
    if ($user->role === 'admin') {
        return redirect()->route('dashboard.admin');
    } else {
        return redirect()->route('dashboard.user');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// User Dashboard
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/user-dashboard', [UserDashboardController::class, 'index'])->name('dashboard.user');
    Route::get('/poems/create', [UserDashboardController::class, 'createPoem'])->name('poems.create');
    Route::get('/poems/{poem}', [UserDashboardController::class, 'showPoem'])->name('poems.show');
    Route::get('/poems/{poem}/edit', [UserDashboardController::class, 'editPoem'])->name('poems.edit');
});

// Admin Dashboard
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/admin-dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.admin');
    Route::get('/admin/users', [AdminDashboardController::class, 'users'])->name('admin.users');
    Route::get('/admin/poems', [AdminDashboardController::class, 'poems'])->name('admin.poems');
    Route::get('/admin/categories', [AdminDashboardController::class, 'categories'])->name('admin.categories');
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
