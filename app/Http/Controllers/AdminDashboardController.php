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
        
        return view('admin.dashboard', compact(
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
     * Show the specified user.
     */
    public function showUser(User $user): View
    {
        $user->load(['poems.category']);
        $recentPoems = $user->poems()->with('category')->latest()->limit(5)->get();
        
        return view('admin.users.show', compact('user', 'recentPoems'));
    }
    
    /**
     * Show the form for editing the specified user.
     */
    public function editUser(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }
    
    /**
     * Update the specified user.
     */
    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'name_bangla' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin',
            'is_active' => 'boolean',
        ]);
        
        $user->update($validated);
        
        return redirect()->route('admin.users.show', $user)
            ->with('success', 'ইউজার সফলভাবে আপডেট হয়েছে।');
    }
    
    /**
     * Remove the specified user.
     */
    public function destroyUser(User $user)
    {
        // Prevent admin from deleting themselves
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users')
                ->with('error', 'আপনি নিজেকে মুছে ফেলতে পারবেন না।');
        }
        
        // Prevent deletion of admin users
        if ($user->role === 'admin') {
            return redirect()->route('admin.users')
                ->with('error', 'অ্যাডমিন ইউজার মুছে ফেলা যাবে না।');
        }
        
        // Delete user's poems first
        $user->poems()->delete();
        
        // Delete the user
        $user->delete();
        
        return redirect()->route('admin.users')
            ->with('success', 'ইউজার সফলভাবে মুছে ফেলা হয়েছে।');
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
    
    /**
     * Show website settings.
     */
    public function settings(): View
    {
        return view('admin.settings');
    }
    
    /**
     * Update website settings.
     */
    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'site_description' => 'nullable|string|max:500',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'favicon' => 'nullable|image|mimes:ico,png,jpg|max:2048',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'admin_email' => 'nullable|email',
            'contact_email' => 'nullable|email',
            'noreply_email' => 'nullable|email',
        ]);
        
        // Handle file uploads
        if ($request->hasFile('site_logo')) {
            $logoPath = $request->file('site_logo')->store('public/settings');
            $validated['site_logo'] = str_replace('public/', '', $logoPath);
        }
        
        if ($request->hasFile('favicon')) {
            $faviconPath = $request->file('favicon')->store('public/settings');
            $validated['favicon'] = str_replace('public/', '', $faviconPath);
        }
        
        // Store settings in config or database
        // For now, we'll store in session or cache
        foreach ($validated as $key => $value) {
            if ($value !== null) {
                config(['app.' . $key => $value]);
            }
        }
        
        return redirect()->route('admin.settings')
            ->with('success', 'সেটিংস সফলভাবে আপডেট হয়েছে।');
    }
    
    /**
     * Show analytics dashboard.
     */
    public function analytics(): View
    {
        // Get analytics data
        $poemsPerMonth = Poem::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();
            
        $usersPerMonth = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();
        
        return view('admin.analytics', compact('poemsPerMonth', 'usersPerMonth'));
    }
    
    /**
     * Show poets management.
     */
    public function poets(): View
    {
        $poets = Poet::withCount('poems')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return view('admin.poets.index', compact('poets'));
    }
    
    /**
     * Show the form for creating a new category.
     */
    public function createCategory(): View
    {
        return view('admin.categories.create');
    }
    
    /**
     * Store a newly created category.
     */
    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name_bangla' => 'required|string|max:255',
            'name_english' => 'nullable|string|max:255',
            'description_bangla' => 'nullable|string|max:500',
            'description_english' => 'nullable|string|max:500',
            'color' => 'nullable|string|max:7',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);
        
        $validated['slug'] = \Str::slug($validated['name_bangla']);
        $validated['is_active'] = $validated['is_active'] ?? true;
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        
        Category::create($validated);
        
        return redirect()->route('admin.categories')
            ->with('success', 'বিভাগ সফলভাবে তৈরি হয়েছে।');
    }
    
    /**
     * Show the form for editing the specified category.
     */
    public function editCategory(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }
    
    /**
     * Update the specified category.
     */
    public function updateCategory(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name_bangla' => 'required|string|max:255',
            'name_english' => 'nullable|string|max:255',
            'description_bangla' => 'nullable|string|max:500',
            'description_english' => 'nullable|string|max:500',
            'color' => 'nullable|string|max:7',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);
        
        $validated['slug'] = \Str::slug($validated['name_bangla']);
        
        $category->update($validated);
        
        return redirect()->route('admin.categories')
            ->with('success', 'বিভাগ সফলভাবে আপডেট হয়েছে।');
    }
    
    /**
     * Remove the specified category.
     */
    public function destroyCategory(Category $category)
    {
        // Check if category has poems
        if ($category->poems()->count() > 0) {
            return redirect()->route('admin.categories')
                ->with('error', 'এই বিভাগে কবিতা আছে, তাই মুছে ফেলা যাবে না।');
        }
        
        $category->delete();
        
        return redirect()->route('admin.categories')
            ->with('success', 'বিভাগ সফলভাবে মুছে ফেলা হয়েছে।');
    }
    
    /**
     * Show the form for creating a new poem (admin version).
     */
    public function createPoem(): View
    {
        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
            
        $poets = Poet::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
            
        $users = User::where('is_active', true)
            ->where('role', 'user')
            ->orderBy('name_bangla')
            ->get();
            
        return view('admin.poems.create', compact('categories', 'poets', 'users'));
    }
    
    /**
     * Store a newly created poem (admin version).
     */
    public function storePoem(Request $request)
    {
        $validated = $request->validate([
            'title_bangla' => 'required|string|max:255',
            'title_english' => 'nullable|string|max:255',
            'content_bangla' => 'required|string',
            'content_english' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'poet_id' => 'nullable|exists:poets,id',
            'user_id' => 'required|exists:users,id',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
            'is_translation' => 'boolean',
            'tags' => 'nullable|string',
        ]);

        $slug = $this->generateUniqueSlug($validated['title_bangla']);
        
        $poem = Poem::create([
            'title_bangla' => $validated['title_bangla'],
            'title_english' => $validated['title_english'],
            'slug' => $slug,
            'content_bangla' => $validated['content_bangla'],
            'content_english' => $validated['content_english'],
            'category_id' => $validated['category_id'],
            'poet_id' => $validated['poet_id'],
            'user_id' => $validated['user_id'],
            'is_published' => $validated['is_published'] ?? false,
            'is_featured' => $validated['is_featured'] ?? false,
            'is_translation' => $validated['is_translation'] ?? false,
        ]);

        // Handle tags if provided
        if (!empty($validated['tags'])) {
            $tagNames = array_map('trim', explode(',', $validated['tags']));
            $poem->syncTags($tagNames);
        }

        return redirect()->route('admin.poems')
            ->with('success', 'কবিতা সফলভাবে সংরক্ষিত হয়েছে।');
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