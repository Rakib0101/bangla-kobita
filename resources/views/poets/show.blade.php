@extends('layouts.bangla-app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Poet Header -->
        <div class="bg-white rounded-lg shadow-md p-8 mb-8">
            <div class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">
                <!-- Poet Image -->
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

                <!-- Poet Info -->
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

        <!-- Poems by this Poet -->
        <div class="bg-white rounded-lg shadow-md p-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-3xl font-bold text-gray-900 bangla-text">
                    {{ $poet->name_bangla }} এর কবিতা
                </h2>
                <span class="text-sm text-gray-500 bangla-text">
                    মোট {{ $poems->total() }}টি কবিতা
                </span>
            </div>

            @if ($poems->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($poems as $poem)
                        <div class="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition duration-300">
                            <!-- Poem Image -->
                            @if ($poem->image_path)
                                <div class="mb-4">
                                    <img src="{{ Storage::url($poem->image_path) }}" alt="{{ $poem->title_bangla }}"
                                        class="w-full h-48 object-cover rounded-lg">
                                </div>
                            @endif

                            <!-- Poem Title -->
                            <h3 class="text-xl font-semibold mb-3 bangla-text">
                                {{ $poem->title_bangla }}
                            </h3>
                            @if ($poem->title_english)
                                <p class="text-sm text-gray-600 mb-3 english-text">{{ $poem->title_english }}</p>
                            @endif

                            <!-- Poem Content Preview -->
                            <p class="text-gray-600 mb-4 bangla-text">
                                {{ Str::limit(strip_tags($poem->content_bangla), 150) }}
                            </p>

                            <!-- Poem Meta -->
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                <span class="bangla-text">{{ $poem->created_at->format('d M Y') }}</span>
                                @if ($poem->category)
                                    <span class="bangla-text">{{ $poem->category->name_bangla }}</span>
                                @endif
                            </div>

                            <!-- Read More Link -->
                            <a href="{{ route('poems.show', $poem) }}"
                                class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm bangla-text">
                                পড়ুন →
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($poems->hasPages())
                    <div class="mt-8">
                        {{ $poems->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2 bangla-text">কোনো কবিতা পাওয়া যায়নি</h3>
                    <p class="text-gray-500 bangla-text">এই কবির কোনো প্রকাশিত কবিতা নেই</p>
                </div>
            @endif
        </div>
    </div>
@endsection
