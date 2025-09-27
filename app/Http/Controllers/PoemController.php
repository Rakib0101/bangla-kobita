<?php

namespace App\Http\Controllers;

use App\Models\Poem;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PoemController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Get the poems category
        $poemsCategory = \App\Models\Category::where('slug', 'kobita')->first();
        
        $poems = Poem::with(['user', 'category'])
            ->where('is_published', true)
            ->when($poemsCategory, function ($query) use ($poemsCategory) {
                return $query->where('category_id', $poemsCategory->id);
            })
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'youtube_embed_code' => 'nullable|string|max:1000',
        ]);

        $slug = $this->generateUniqueSlug($validated['title_bangla']);
        
        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('poem-images', 'public');
        }
        
        $poem = Auth::user()->poems()->create([
            'title_bangla' => $validated['title_bangla'],
            'title_english' => $validated['title_english'],
            'slug' => $slug,
            'content_bangla' => $validated['content_bangla'],
            'content_english' => $validated['content_english'],
            'image_path' => $imagePath,
            'youtube_embed_code' => $validated['youtube_embed_code'],
            'category_id' => $validated['category_id'],
            'is_published' => $validated['is_published'] ?? false,
        ]);

        // Handle tags if provided
        if (!empty($validated['tags'])) {
            $tagNames = array_map('trim', explode(',', $validated['tags']));
            $poem->syncTags($tagNames);
        }

        return redirect()->route('posts.show', $poem)
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'youtube_embed_code' => 'nullable|string|max:1000',
        ]);

        $slug = $this->generateUniqueSlug($validated['title_bangla'], $poem->id);
        
        // Handle image upload
        $imagePath = $poem->image_path; // Keep existing image if no new one uploaded
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($poem->image_path && Storage::disk('public')->exists($poem->image_path)) {
                Storage::disk('public')->delete($poem->image_path);
            }
            $imagePath = $request->file('image')->store('poem-images', 'public');
        }
        
        $poem->update([
            'title_bangla' => $validated['title_bangla'],
            'title_english' => $validated['title_english'],
            'slug' => $slug,
            'content_bangla' => $validated['content_bangla'],
            'content_english' => $validated['content_english'],
            'image_path' => $imagePath,
            'youtube_embed_code' => $validated['youtube_embed_code'],
            'category_id' => $validated['category_id'],
            'is_published' => $validated['is_published'] ?? false,
        ]);

        // Handle tags if provided
        if (!empty($validated['tags'])) {
            $tagNames = array_map('trim', explode(',', $validated['tags']));
            $poem->syncTags($tagNames);
        }

        return redirect()->route('posts.show', $poem)
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

    /**
     * Generate a unique slug for the poem
     */
    private function generateUniqueSlug(string $title, ?int $excludeId = null): string
    {
        $slug = \Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (Poem::where('slug', $slug)->when($excludeId, function ($query) use ($excludeId) {
            return $query->where('id', '!=', $excludeId);
        })->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}