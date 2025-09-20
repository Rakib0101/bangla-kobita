@extends('layouts.bangla-app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 bangla-text">সব কবিতা</h1>
                    <p class="text-gray-600 bangla-text mt-2">বাংলা কবিতার সংগ্রহ</p>
                </div>
                @auth
                    <a href="{{ route('poems.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded bangla-text">
                        নতুন কবিতা লিখুন
                    </a>
                @endauth
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <form method="GET" action="{{ route('poems.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                            খুঁজুন
                        </label>
                        <input type="text" id="search" name="search" value="{{ request('search') }}"
                            placeholder="কবিতার শিরোনাম বা বিষয়বস্তু খুঁজুন"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bangla-text">
                    </div>
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                            বিভাগ
                        </label>
                        <select id="category" name="category"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">সব বিভাগ</option>
                            @foreach (\App\Models\Category::where('is_active', true)->get() as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name_bangla }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded bangla-text">
                            খুঁজুন
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Poems Grid -->
        @if ($poems->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($poems as $poem)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="p-6">
                            <div class="mb-4">
                                <h3 class="text-xl font-semibold text-gray-900 bangla-text mb-2">
                                    <a href="{{ route('poems.show', $poem) }}"
                                        class="hover:text-blue-600 transition-colors">
                                        {{ $poem->title_bangla }}
                                    </a>
                                </h3>
                                @if ($poem->title_english)
                                    <p class="text-gray-600 italic">{{ $poem->title_english }}</p>
                                @endif
                            </div>

                            <div class="mb-4">
                                <p class="text-gray-700 bangla-text line-clamp-3">
                                    {{ Str::limit(strip_tags($poem->content_bangla), 150) }}
                                </p>
                            </div>

                            <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span class="bangla-text">{{ $poem->user->name_bangla ?? $poem->user->name }}</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>{{ $poem->created_at->format('d M Y') }}</span>
                                </div>
                            </div>

                            @if ($poem->category)
                                <div class="mb-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 bangla-text">
                                        {{ $poem->category->name_bangla }}
                                    </span>
                                </div>
                            @endif

                            <div class="flex items-center justify-between">
                                <a href="{{ route('poems.show', $poem) }}"
                                    class="text-blue-600 hover:text-blue-800 bangla-text">
                                    পড়ুন →
                                </a>
                                <div class="flex items-center space-x-2">
                                    <button class="text-gray-400 hover:text-red-500 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button class="text-gray-400 hover:text-blue-500 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $poems->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900 bangla-text">কোন কবিতা পাওয়া যায়নি</h3>
                <p class="mt-1 text-sm text-gray-500 bangla-text">এখনো কোন কবিতা প্রকাশিত হয়নি।</p>
                @auth
                    <div class="mt-6">
                        <a href="{{ route('poems.create') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 bangla-text">
                            প্রথম কবিতা লিখুন
                        </a>
                    </div>
                @endauth
            </div>
        @endif
    </div>

    <style>
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection
