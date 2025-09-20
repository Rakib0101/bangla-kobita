@extends('layouts.bangla-app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 bangla-text">আসরের সাম্প্রতিক কবিতা</h1>
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

        <!-- Poems List Table -->
        @if ($poems->count() > 0)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 bangla-text">
                        কবিতার তালিকা ({{ $poems->total() }} টি)
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bangla-text">
                                    তারিখ
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bangla-text">
                                    শিরোনাম
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bangla-text">
                                    কবি
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bangla-text">
                                    মন্তব্য
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($poems as $poem)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $poem->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex-1 min-w-0">
                                            <div class="text-sm font-medium text-gray-900 bangla-text mb-2">
                                                <a href="{{ route('poems.show', $poem) }}"
                                                    class="hover:text-blue-600 transition-colors {{ $loop->odd ? 'text-red-600' : 'text-gray-900' }}">
                                                    {{ $poem->title_bangla }}
                                                </a>
                                            </div>
                                            <!-- Show 8 lines of poem content -->
                                            <div class="text-xs text-gray-600 bangla-text poem-preview">
                                                {!! \App\Helpers\PoemHelper::formatPoemPreview($poem->content_bangla, 8) !!}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 bangla-text">
                                            {{ $poem->user->name_bangla ?? $poem->user->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ rand(0, 6) }} <!-- Placeholder for comment count -->
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($poems->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $poems->links() }}
                    </div>
                @endif
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
        .poem-preview {
            line-height: 1.6;
            white-space: pre-line;
            font-family: 'AbuJMAkkas', 'Kalpurush', 'SolaimanLipi', 'Bangla', 'Noto Sans Bengali', sans-serif;
        }

        .poem-preview::after {
            content: "...";
            color: #6B7280;
            font-weight: bold;
        }
    </style>
@endsection
