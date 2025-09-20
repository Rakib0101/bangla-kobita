<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Poem;
use App\Models\Category;

class UserDashboardController extends Controller
{
    /**
     * Display the user dashboard.
     */
    public function index(): View
    {
        $user = auth()->user();
        
        // Get user's poems with pagination
        $poems = $user->poems()
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        // Get recent poems count
        $recentPoemsCount = $user->poems()
            ->where('created_at', '>=', now()->subDays(30))
            ->count();
        
        // Get total poems count
        $totalPoemsCount = $user->poems()->count();
        
        // Get published poems count
        $publishedPoemsCount = $user->poems()
            ->where('is_published', true)
            ->count();
        
        return view('dashboard.user', compact(
            'poems',
            'recentPoemsCount',
            'totalPoemsCount',
            'publishedPoemsCount'
        ));
    }
    
    /**
     * Show the form for creating a new poem.
     */
    public function createPoem(): View
    {
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
            
        return view('poems.create', compact('categories'));
    }
    
    /**
     * Display the specified poem.
     */
    public function showPoem(Poem $poem): View
    {
        // Ensure the poem belongs to the authenticated user
        if ($poem->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this poem.');
        }
        
        return view('poems.show', compact('poem'));
    }
    
    /**
     * Show the form for editing the specified poem.
     */
    public function editPoem(Poem $poem): View
    {
        // Ensure the poem belongs to the authenticated user
        if ($poem->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this poem.');
        }
        
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
            
        return view('poems.edit', compact('poem', 'categories'));
    }
}