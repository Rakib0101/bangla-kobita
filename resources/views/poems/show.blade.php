@extends('layouts.bangla-app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Poem Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 bangla-text mb-2">
                        {{ $poem->title_bangla }}
                    </h1>
                </div>
                <div class="flex space-x-2">
                    @if (auth()->check() && auth()->id() === $poem->user_id)
                        <a href="{{ route('posts.edit', $poem) }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded bangla-text">
                            সম্পাদনা
                        </a>
                        <form method="POST" action="{{ route('posts.destroy', $poem) }}" class="inline"
                            onsubmit="return confirm('আপনি কি নিশ্চিত যে আপনি এই কবিতাটি মুছে ফেলতে চান?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded bangla-text">
                                মুছুন
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Poem Meta Information -->
            <div class="border-t border-gray-200 pt-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-600">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="bangla-text">{{ $poem->user->name_bangla ?? $poem->user->name }}</span>
                    </div>
                    @if ($poem->category)
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                            <span class="bangla-text">{{ $poem->category->name_bangla }}</span>
                        </div>
                    @endif
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ $poem->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Poem Content -->
        <div class="bg-white rounded-lg shadow-md p-8 mb-6">
            <!-- Image Display -->
            @if ($poem->image_path)
                <div class="mb-8 text-center">
                    <img src="{{ Storage::url($poem->image_path) }}" alt="{{ $poem->title_bangla }}"
                        class="max-w-full h-auto mx-auto rounded-lg shadow-lg">
                </div>
            @endif

            <div class="prose prose-lg max-w-none">
                <div class="bangla-text text-lg leading-relaxed whitespace-pre-line">
                    {{ $poem->content_bangla }}
                </div>

            </div>

            <!-- YouTube Video Display -->
            @if ($poem->youtube_embed_code)
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4 bangla-text">কবিতা পাঠ/গান</h3>
                    <div class="flex justify-center">
                        <div class="w-full max-w-2xl">
                            {!! $poem->youtube_embed_code !!}
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Tags -->
        @if ($poem->tags && $poem->tags->count() > 0)
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4 bangla-text">ট্যাগ</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach ($poem->tags as $tag)
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 bangla-text">
                            {{ $tag->name }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Actions -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div class="flex space-x-4">
                    <button class="flex items-center space-x-2 text-gray-600 hover:text-red-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                            </path>
                        </svg>
                        <span class="bangla-text">পছন্দ</span>
                    </button>
                    <button class="flex items-center space-x-2 text-gray-600 hover:text-blue-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z">
                            </path>
                        </svg>
                        <span class="bangla-text">শেয়ার</span>
                    </button>
                </div>
                <a href="{{ route('posts.index') }}" class="text-blue-600 hover:text-blue-800 bangla-text">
                    ← সব কবিতা দেখুন
                </a>
            </div>
        </div>
    </div>
@endsection
