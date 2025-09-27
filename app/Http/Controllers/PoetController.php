<?php

namespace App\Http\Controllers;

use App\Models\Poet;
use App\Models\Poem;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PoetController extends Controller
{
    /**
     * Display a listing of poets.
     */
    public function index(): View
    {
        $featuredPoets = Poet::where('is_featured', true)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();
            
        $allPoets = Poet::where('is_active', true)
            ->orderBy('sort_order')
            ->paginate(20);
            
        return view('poets.index', compact('featuredPoets', 'allPoets'));
    }

    /**
     * Display the specified poet.
     */
    public function show(Poet $poet): View
    {
        // Find users whose names match the poet's name
        $matchingUsers = \App\Models\User::where(function($query) use ($poet) {
            $query->where('name_bangla', 'LIKE', '%' . $poet->name_bangla . '%')
                  ->orWhere('name', 'LIKE', '%' . $poet->name_bangla . '%')
                  ->orWhere('name_english', 'LIKE', '%' . $poet->name_english . '%');
        })->pluck('id')->toArray();
        
        // Get all published content by this writer, organized by category
        $contentByCategory = [];
        $categories = \App\Models\Category::where('is_active', true)->orderBy('sort_order')->get();
        
        foreach ($categories as $category) {
            $content = \App\Models\Poem::with(['user', 'category'])
                ->where(function($query) use ($matchingUsers, $poet) {
                    $query->whereIn('user_id', $matchingUsers)
                          ->orWhere('poet_id', $poet->id);
                })
                ->where('category_id', $category->id)
                ->where('is_published', true)
                ->orderBy('created_at', 'desc')
                ->limit(6)
                ->get();
                
            if ($content->count() > 0) {
                $contentByCategory[$category->slug] = [
                    'category' => $category,
                    'content' => $content
                ];
            }
        }
        
        // Get total count of all content
        $totalContent = \App\Models\Poem::where(function($query) use ($matchingUsers, $poet) {
            $query->whereIn('user_id', $matchingUsers)
                  ->orWhere('poet_id', $poet->id);
        })
        ->where('is_published', true)
        ->count();
        
        return view('poets.show', compact('poet', 'contentByCategory', 'totalContent'));
    }
}