<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PoemController;
use App\Http\Controllers\AddaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');


// Public routes
Route::get('/poems', [PoemController::class, 'index'])->name('poems.index');

Route::get('/poets', function () {
    return view('poets.index');
})->name('poets.index');

Route::get('/categories', function () {
    return view('categories.index');
})->name('categories.index');

// Adda (Group Chat) routes
Route::middleware(['auth'])->group(function () {
    Route::get('/adda', [AddaController::class, 'index'])->name('adda.index');
    Route::post('/adda', [AddaController::class, 'store'])->name('adda.store');
});

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
Route::middleware(['auth'])->group(function () {
    Route::get('/user-dashboard', [UserDashboardController::class, 'index'])->name('dashboard.user');
    
    // Poem management routes for authenticated users - specific routes first
    Route::get('/poems/create', [PoemController::class, 'create'])->name('poems.create');
    Route::post('/poems', [PoemController::class, 'store'])->name('poems.store');
    Route::get('/poems/{poem}/edit', [PoemController::class, 'edit'])->name('poems.edit');
    Route::put('/poems/{poem}', [PoemController::class, 'update'])->name('poems.update');
    Route::delete('/poems/{poem}', [PoemController::class, 'destroy'])->name('poems.destroy');
});

// Public poem show route - after specific routes
Route::get('/poems/{poem}', [PoemController::class, 'show'])->name('poems.show');

// Admin Dashboard
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/admin-dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.admin');
    Route::get('/admin/users', [AdminDashboardController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/{user}', [AdminDashboardController::class, 'showUser'])->name('admin.users.show');
    Route::get('/admin/users/{user}/edit', [AdminDashboardController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminDashboardController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminDashboardController::class, 'destroyUser'])->name('admin.users.destroy');
    Route::get('/admin/poems', [AdminDashboardController::class, 'poems'])->name('admin.poems');
    Route::get('/admin/poems/create', [AdminDashboardController::class, 'createPoem'])->name('admin.poems.create');
    Route::post('/admin/poems', [AdminDashboardController::class, 'storePoem'])->name('admin.poems.store');
    Route::get('/admin/categories', [AdminDashboardController::class, 'categories'])->name('admin.categories');
    Route::get('/admin/categories/create', [AdminDashboardController::class, 'createCategory'])->name('admin.categories.create');
    Route::post('/admin/categories', [AdminDashboardController::class, 'storeCategory'])->name('admin.categories.store');
    Route::get('/admin/categories/{category}/edit', [AdminDashboardController::class, 'editCategory'])->name('admin.categories.edit');
    Route::put('/admin/categories/{category}', [AdminDashboardController::class, 'updateCategory'])->name('admin.categories.update');
    Route::delete('/admin/categories/{category}', [AdminDashboardController::class, 'destroyCategory'])->name('admin.categories.destroy');
    Route::get('/admin/poets', [AdminDashboardController::class, 'poets'])->name('admin.poets');
    Route::get('/admin/settings', [AdminDashboardController::class, 'settings'])->name('admin.settings');
    Route::put('/admin/settings', [AdminDashboardController::class, 'updateSettings'])->name('admin.settings.update');
    Route::get('/admin/analytics', [AdminDashboardController::class, 'analytics'])->name('admin.analytics');
    Route::get('/admin/test', function() { return view('admin.test'); })->name('admin.test');
    Route::get('/admin/debug', function() { 
        $poems = \App\Models\Poem::with(['user', 'category'])->get();
        return response()->json([
            'poems_count' => $poems->count(),
            'poems' => $poems->map(function($poem) {
                return [
                    'id' => $poem->id,
                    'title' => $poem->title_bangla ?? $poem->title,
                    'user' => $poem->user->name_bangla ?? $poem->user->name,
                    'category' => $poem->category->name_bangla ?? $poem->category->name,
                    'is_published' => $poem->is_published
                ];
            })
        ]);
    })->name('admin.debug');
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
