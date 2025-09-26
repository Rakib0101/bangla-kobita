<?php

namespace App\Http\Controllers;

use App\Models\Poem;
use App\Models\Poet;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the home page with dynamic content.
     */
    public function index(): View
    {
        // Get latest published poems
        $latestPoems = Poem::with(['user', 'category'])
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();
            
        // Get featured poems
        $featuredPoems = Poem::with(['user', 'category'])
            ->where('is_published', true)
            ->where('is_featured', true)
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();
            
        // Get active categories with poem counts
        $categories = Category::where('is_active', true)
            ->withCount(['poems' => function ($query) {
                $query->where('is_published', true);
            }])
            ->orderBy('sort_order')
            ->limit(8)
            ->get();
            
        // Get featured poets
        $featuredPoets = Poet::where('is_featured', true)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->limit(4)
            ->get();
            
        // Get statistics
        $stats = [
            'total_poems' => Poem::where('is_published', true)->count(),
            'total_poets' => Poet::where('is_active', true)->count(),
            'total_users' => User::count(),
            'total_views' => Poem::where('is_published', true)->sum('views'),
        ];
        
        return view('home', compact(
            'latestPoems', 
            'featuredPoems', 
            'categories', 
            'featuredPoets', 
            'stats'
        ));
    }
}