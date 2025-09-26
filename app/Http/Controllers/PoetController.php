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
        $poet->load(['poems' => function ($query) {
            $query->where('is_published', true)->orderBy('created_at', 'desc');
        }]);
        
        $poems = $poet->poems()->paginate(12);
        
        return view('poets.show', compact('poet', 'poems'));
    }
}