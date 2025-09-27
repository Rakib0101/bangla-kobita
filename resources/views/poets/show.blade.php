@extends('layouts.bangla-app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Writer Header -->
        <div class="bg-white rounded-lg shadow-md p-8 mb-8">
            <div class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">
                <!-- Writer Image -->
                <div class="flex-shrink-0">
                    <div class="w-32 h-32 bg-gray-200 rounded-full flex items-center justify-center">
                        @if ($poet->image)
                            <img src="{{ Storage::url($poet->image) }}" alt="{{ $poet->name_bangla }}"
                                class="w-32 h-32 rounded-full object-cover">
                        @else
                            <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        @endif
                    </div>
                </div>

                <!-- Writer Info -->
                <div class="flex-1 text-center md:text-left">
                    <h1 class="text-4xl font-bold text-gray-900 bangla-text mb-2">
                        {{ $poet->name_bangla }}
                    </h1>
                    @if ($poet->name_english)
                        <p class="text-xl text-gray-600 english-text mb-4">{{ $poet->name_english }}</p>
                    @endif

                    <!-- Birth/Death Info -->
                    <div class="text-sm text-gray-500 mb-4 bangla-text">
                        জন্ম: {{ $poet->birth_date ? $poet->birth_date->format('d M Y') : 'অজানা' }}
                        @if ($poet->birth_place)
                            ({{ $poet->birth_place }})
                        @endif
                        @if ($poet->death_date)
                            | মৃত্যু: {{ $poet->death_date->format('d M Y') }}
                        @endif
                    </div>

                    <!-- Biography -->
                    @if ($poet->biography_bangla)
                        <div class="prose prose-lg max-w-none">
                            <p class="text-gray-700 bangla-text leading-relaxed">
                                {{ $poet->biography_bangla }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Writings by this Writer -->
        <div class="bg-white rounded-lg shadow-md p-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-3xl font-bold text-gray-900 bangla-text">
                    {{ $poet->name_bangla }} এর রচনা
                </h2>
                <span class="text-sm text-gray-500 bangla-text">
                    মোট {{ $totalContent }}টি রচনা
                </span>
            </div>

            @if (count($contentByCategory) > 0)
                @foreach ($contentByCategory as $categorySlug => $categoryData)
                    <div class="mb-8">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-2xl font-bold bangla-text"
                                style="color: {{ $categoryData['category']->color }}">
                                {{ $categoryData['category']->name_bangla }}
                            </h3>
                            <span class="text-sm text-gray-500 bangla-text">
                                {{ $categoryData['content']->count() }}টি {{ $categoryData['category']->name_bangla }}
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($categoryData['content'] as $content)
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-lg transition duration-300">
                                    <!-- Content Image -->
                                    @if ($content->image_path)
                                        <div class="mb-3">
                                            <img src="{{ Storage::url($content->image_path) }}"
                                                alt="{{ $content->title_bangla }}"
                                                class="w-full h-32 object-cover rounded-lg">
                                        </div>
                                    @endif

                                    <!-- Content Title -->
                                    <h4 class="text-lg font-semibold mb-2 bangla-text">
                                        {{ $content->title_bangla }}
                                    </h4>

                                    <!-- Content Preview -->
                                    <p class="text-gray-600 mb-3 bangla-text text-sm">
                                        {{ Str::limit(strip_tags($content->content_bangla), 100) }}
                                    </p>

                                    <!-- Content Meta -->
                                    <div class="flex items-center justify-between text-xs text-gray-500 mb-3">
                                        <span class="bangla-text">{{ $content->created_at->format('d M Y') }}</span>
                                        <span class="px-2 py-1 rounded-full text-xs"
                                            style="background-color: {{ $categoryData['category']->color }}20; color: {{ $categoryData['category']->color }}">
                                            {{ $categoryData['category']->name_bangla }}
                                        </span>
                                    </div>

                                    <!-- Read More Link -->
                                    <a href="{{ route('posts.show', $content) }}"
                                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm bangla-text">
                                        পড়ুন →
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2 bangla-text">কোনো রচনা পাওয়া যায়নি</h3>
                    <p class="text-gray-500 bangla-text">এই লেখকের কোনো প্রকাশিত রচনা নেই</p>
                </div>
            @endif
        </div>
    </div>
@endsection
