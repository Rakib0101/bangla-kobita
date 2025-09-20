@extends('layouts.bangla-app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold mb-4 bangla-text">কবিতা সংগ্রহ</h1>
        <p class="text-lg text-gray-600 bangla-text">বাংলা কবিতার একটি বিশাল সংগ্রহ</p>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="category_filter" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                    বিভাগ
                </label>
                <select id="category_filter" class="block w-full border border-gray-300 rounded-md px-3 py-2">
                    <option value="">সব বিভাগ</option>
                    @foreach(\App\Models\Category::where('is_active', true)->orderBy('sort_order')->get() as $category)
                        <option value="{{ $category->id }}">{{ $category->name_bangla }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="poet_filter" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                    কবি
                </label>
                <select id="poet_filter" class="block w-full border border-gray-300 rounded-md px-3 py-2">
                    <option value="">সব কবি</option>
                    @foreach(\App\Models\Poet::where('is_active', true)->orderBy('sort_order')->get() as $poet)
                        <option value="{{ $poet->id }}">{{ $poet->name_bangla }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                    খুঁজুন
                </label>
                <input type="text" 
                       id="search" 
                       placeholder="কবিতা খুঁজুন..."
                       class="block w-full border border-gray-300 rounded-md px-3 py-2 bangla-input">
            </div>
            
            <div class="flex items-end">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md bangla-text">
                    খুঁজুন
                </button>
            </div>
        </div>
    </div>

    <!-- Poems Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @for($i = 1; $i <= 12; $i++)
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300">
            <!-- Featured Badge -->
            @if($i <= 3)
            <div class="mb-4">
                <span class="inline-block bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded bangla-text">
                    বিশেষ
                </span>
            </div>
            @endif
            
            <!-- Category -->
            <div class="mb-3">
                <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded bangla-text">
                    প্রেমের কবিতা
                </span>
            </div>
            
            <!-- Poem Title -->
            <h3 class="text-xl font-semibold mb-3 bangla-text">
                কবিতার শিরোনাম {{ $i }}
            </h3>
            
            <!-- Poem Preview -->
            <p class="text-gray-600 mb-4 bangla-text">
                কবিতার প্রথম কয়েকটি লাইন এখানে থাকবে। এটি একটি নমুনা কবিতা যেখানে আমরা দেখতে পারি কিভাবে কবিতা প্রদর্শিত হবে। কবিতার সৌন্দর্য এবং অর্থ এখানে ফুটে উঠবে...
            </p>
            
            <!-- Poet and Stats -->
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center mr-2">
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <span class="text-sm text-gray-600 bangla-text">রবীন্দ্রনাথ ঠাকুর</span>
                </div>
                <div class="flex items-center space-x-4 text-sm text-gray-500">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        {{ rand(10, 999) }}
                    </span>
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        {{ rand(5, 99) }}
                    </span>
                </div>
            </div>
            
            <!-- Tags -->
            <div class="mb-4">
                <div class="flex flex-wrap gap-1">
                    <span class="inline-block bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded bangla-text">প্রেম</span>
                    <span class="inline-block bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded bangla-text">জীবন</span>
                    <span class="inline-block bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded bangla-text">প্রকৃতি</span>
                </div>
            </div>
            
            <!-- Read More Button -->
            <a href="#" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 rounded-md transition duration-300 bangla-text">
                কবিতা পড়ুন
            </a>
        </div>
        @endfor
    </div>

    <!-- Pagination -->
    <div class="mt-8 flex justify-center">
        <nav class="flex space-x-2">
            <a href="#" class="px-3 py-2 bg-gray-200 text-gray-600 rounded-md hover:bg-gray-300 bangla-text">পূর্ববর্তী</a>
            <a href="#" class="px-3 py-2 bg-blue-600 text-white rounded-md bangla-text">1</a>
            <a href="#" class="px-3 py-2 bg-gray-200 text-gray-600 rounded-md hover:bg-gray-300 bangla-text">2</a>
            <a href="#" class="px-3 py-2 bg-gray-200 text-gray-600 rounded-md hover:bg-gray-300 bangla-text">3</a>
            <a href="#" class="px-3 py-2 bg-gray-200 text-gray-600 rounded-md hover:bg-gray-300 bangla-text">পরবর্তী</a>
        </nav>
    </div>
</div>
@endsection
