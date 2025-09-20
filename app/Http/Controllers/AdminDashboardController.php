<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Poem;
use App\Models\Category;
use App\Models\Poet;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index(): View
    {
        // Get statistics for admin dashboard
        $totalUsers = User::count();
        $activeUsers = User::where('is_active', true)->count();
        $totalPoems = Poem::count();
        $publishedPoems = Poem::where('is_published', true)->count();
        $totalCategories = Category::count();
        $totalPoets = Poet::count();
        
        // Get recent users
        $recentUsers = User::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Get recent poems
        $recentPoems = Poem::with(['user', 'category'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Get poems pending approval (if you have an approval system)
        $pendingPoems = Poem::where('is_published', false)
            ->with(['user', 'category'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        return view('dashboard.admin', compact(
            'totalUsers',
            'activeUsers',
            'totalPoems',
            'publishedPoems',
            'totalCategories',
            'totalPoets',
            'recentUsers',
            'recentPoems',
            'pendingPoems'
        ));
    }
    
    /**
     * Show all users for admin management.
     */
    public function users(): View
    {
        $users = User::withCount('poems')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return view('admin.users.index', compact('users'));
    }
    
    /**
     * Show all poems for admin management.
     */
    public function poems(Request $request): View
    {
        $query = Poem::with(['user', 'category']);
        
        // Filter by status
        if ($request->has('status')) {
            switch ($request->status) {
                case 'published':
                    $query->where('is_published', true);
                    break;
                case 'draft':
                    $query->where('is_published', false);
                    break;
                // 'all' or no status means no filter
            }
        }
        
        $poems = $query->orderBy('created_at', 'desc')->paginate(20);
            
        return view('admin.poems.index', compact('poems'));
    }
    
    /**
     * Show all categories for admin management.
     */
    public function categories(): View
    {
        $categories = Category::withCount('poems')
            ->orderBy('sort_order')
            ->paginate(20);
            
        return view('admin.categories.index', compact('categories'));
    }
}