@props(['featuredWritings' => [], 'popularWriters' => [], 'recentComments' => []])

<div class="w-full lg:w-80 bg-white border border-gray-200 rounded-lg shadow-sm p-6 space-y-6">
    <!-- Featured Writings Section -->
    <div>
        <div class="flex items-center mb-4">
            <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                    </path>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-800 bangla-text">বিশেষ রচনা</h3>
        </div>

        <div class="space-y-4">
            @forelse($featuredWritings as $writing)
                <div class="border-l-4 border-gray-400 pl-4 py-2 hover:bg-gray-50 transition-colors duration-200">
                    <h4 class="font-semibold text-gray-800 mb-1 bangla-text">
                        <a href="{{ route('posts.show', $writing) }}" class="hover:text-gray-600">
                            {{ $writing->title_bangla }}
                        </a>
                    </h4>
                    <p class="text-sm text-gray-600 mb-2 bangla-text">
                        {{ Str::limit(strip_tags($writing->content_bangla), 80) }}
                    </p>
                    <div class="flex items-center justify-between text-xs text-gray-500">
                        <span class="bangla-text">{{ $writing->user->name_bangla ?? $writing->user->name }}</span>
                        <span>{{ $writing->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <p class="text-gray-500 bangla-text">কোনো বিশেষ রচনা নেই</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Popular Writers Section -->
    <div>
        <div class="flex items-center mb-4">
            <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-800 bangla-text">জনপ্রিয় লেখক</h3>
        </div>

        <div class="space-y-3">
            @forelse($popularWriters as $writer)
                <div class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center flex-shrink-0">
                        @if ($writer->image)
                            <img src="{{ Storage::url($writer->image) }}" alt="{{ $writer->name_bangla }}"
                                class="w-10 h-10 rounded-full object-cover">
                        @else
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="font-medium text-gray-800 bangla-text truncate">
                            <a href="{{ route('poets.show', $writer) }}" class="hover:text-gray-600">
                                {{ $writer->name_bangla }}
                            </a>
                        </h4>
                        <p class="text-sm text-gray-500">{{ $writer->poems_count ?? 0 }}টি রচনা</p>
                    </div>
                </div>
            @empty
                <div class="text-center py-6">
                    <svg class="w-10 h-10 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <p class="text-gray-500 bangla-text text-sm">কোনো লেখক নেই</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Recent Comments Section -->
    <div>
        <div class="flex items-center mb-4">
            <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                    </path>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-800 bangla-text">সাম্প্রতিক মন্তব্য</h3>
        </div>

        <div class="space-y-3">
            @forelse($recentComments as $comment)
                <div class="bg-gray-50 rounded-lg p-3 hover:bg-gray-100 transition-colors duration-200">
                    <p class="text-sm text-gray-700 mb-2 bangla-text">
                        {{ Str::limit($comment->content, 60) }}
                    </p>
                    <div class="flex items-center justify-between text-xs text-gray-500">
                        <span class="bangla-text">{{ $comment->user->name_bangla ?? $comment->user->name }}</span>
                        <span>{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            @empty
                <div class="text-center py-6">
                    <svg class="w-10 h-10 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                        </path>
                    </svg>
                    <p class="text-gray-500 bangla-text text-sm">কোনো মন্তব্য নেই</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Quick Links Section -->
    <div>
        <div class="flex items-center mb-4">
            <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center mr-3">
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                    </path>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-800 bangla-text">দ্রুত লিংক</h3>
        </div>

        <div class="space-y-2">
            <a href="{{ route('posts.index') }}"
                class="flex items-center text-gray-600 hover:text-gray-800 py-2 px-3 rounded-lg hover:bg-gray-50 transition-colors duration-200 bangla-text">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                    </path>
                </svg>
                সব কবিতা
            </a>
            <a href="{{ route('poets.index') }}"
                class="flex items-center text-gray-600 hover:text-gray-800 py-2 px-3 rounded-lg hover:bg-gray-50 transition-colors duration-200 bangla-text">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                সব লেখক
            </a>
            <a href="{{ route('categories.index') }}"
                class="flex items-center text-gray-600 hover:text-gray-800 py-2 px-3 rounded-lg hover:bg-gray-50 transition-colors duration-200 bangla-text">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                    </path>
                </svg>
                বিভাগসমূহ
            </a>
            @auth
                <a href="{{ route('posts.create') }}"
                    class="flex items-center text-gray-600 hover:text-gray-800 py-2 px-3 rounded-lg hover:bg-gray-50 transition-colors duration-200 bangla-text">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    নতুন লেখা
                </a>
            @endauth
        </div>
    </div>
</div>
