<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PoemController;
use App\Http\Controllers\PoetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AddaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');


// Public routes
Route::get('/posts', [PoemController::class, 'index'])->name('posts.index');

Route::get('/poets', [PoetController::class, 'index'])->name('poets.index');
Route::get('/poets/{poet}', [PoetController::class, 'show'])->name('poets.show');

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
    
    // Post management routes for authenticated users - specific routes first
    Route::get('/posts/create', [PoemController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PoemController::class, 'store'])->name('posts.store');
    Route::get('/posts/{poem}/edit', [PoemController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{poem}', [PoemController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{poem}', [PoemController::class, 'destroy'])->name('posts.destroy');
});

// Public post show route - after specific routes
Route::get('/posts/{poem}', [PoemController::class, 'show'])->name('posts.show');

// Admin Dashboard
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/admin-dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.admin');
    Route::get('/admin/users', [AdminDashboardController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/{user}', [AdminDashboardController::class, 'showUser'])->name('admin.users.show');
    Route::get('/admin/users/{user}/edit', [AdminDashboardController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminDashboardController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminDashboardController::class, 'destroyUser'])->name('admin.users.destroy');
    Route::get('/admin/posts', [AdminDashboardController::class, 'poems'])->name('admin.posts');
    Route::get('/admin/posts/create', [AdminDashboardController::class, 'createPoem'])->name('admin.posts.create');
    Route::post('/admin/posts', [AdminDashboardController::class, 'storePoem'])->name('admin.posts.store');
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
