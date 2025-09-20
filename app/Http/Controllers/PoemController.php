<?php

namespace App\Http\Controllers;

use App\Models\Poem;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class PoemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $poems = Poem::with(['user', 'category'])
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            
        return view('poems.index', compact('poems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        try {
            $categories = Category::where('is_active', true)
                ->orderBy('sort_order')
                ->get();
                
            return view('poems.create', compact('categories'));
        } catch (\Exception $e) {
            // If there's an error, return a simple view first
            return view('poems.create', ['categories' => collect()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title_bangla' => 'required|string|max:255',
            'title_english' => 'nullable|string|max:255',
            'content_bangla' => 'required|string',
            'content_english' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'is_published' => 'boolean',
            'tags' => 'nullable|string',
        ]);

        $poem = Auth::user()->poems()->create([
            'title_bangla' => $validated['title_bangla'],
            'title_english' => $validated['title_english'],
            'content_bangla' => $validated['content_bangla'],
            'content_english' => $validated['content_english'],
            'category_id' => $validated['category_id'],
            'is_published' => $validated['is_published'] ?? false,
        ]);

        // Handle tags if provided
        if (!empty($validated['tags'])) {
            $tagNames = array_map('trim', explode(',', $validated['tags']));
            $poem->syncTags($tagNames);
        }

        return redirect()->route('poems.show', $poem)
            ->with('success', 'কবিতা সফলভাবে সংরক্ষিত হয়েছে।');
    }

    /**
     * Display the specified resource.
     */
    public function show(Poem $poem): View
    {
        $poem->load(['user', 'category', 'tags']);
        return view('poems.show', compact('poem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Poem $poem): View
    {
        // Ensure the poem belongs to the authenticated user
        if ($poem->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this poem.');
        }

        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
            
        return view('poems.edit', compact('poem', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Poem $poem): RedirectResponse
    {
        // Ensure the poem belongs to the authenticated user
        if ($poem->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this poem.');
        }

        $validated = $request->validate([
            'title_bangla' => 'required|string|max:255',
            'title_english' => 'nullable|string|max:255',
            'content_bangla' => 'required|string',
            'content_english' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'is_published' => 'boolean',
            'tags' => 'nullable|string',
        ]);

        $poem->update([
            'title_bangla' => $validated['title_bangla'],
            'title_english' => $validated['title_english'],
            'content_bangla' => $validated['content_bangla'],
            'content_english' => $validated['content_english'],
            'category_id' => $validated['category_id'],
            'is_published' => $validated['is_published'] ?? false,
        ]);

        // Handle tags if provided
        if (!empty($validated['tags'])) {
            $tagNames = array_map('trim', explode(',', $validated['tags']));
            $poem->syncTags($tagNames);
        }

        return redirect()->route('poems.show', $poem)
            ->with('success', 'কবিতা সফলভাবে আপডেট হয়েছে।');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Poem $poem): RedirectResponse
    {
        // Ensure the poem belongs to the authenticated user
        if ($poem->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this poem.');
        }

        $poem->delete();

        return redirect()->route('dashboard.user')
            ->with('success', 'কবিতা সফলভাবে মুছে ফেলা হয়েছে।');
    }
}