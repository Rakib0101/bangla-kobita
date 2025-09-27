@extends('layouts.admin')

@section('title', 'Poems Management')
@section('page-title', 'কবিতা ম্যানেজমেন্ট')

@section('content')
    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 bangla-text">কবিতা তালিকা</h2>
                <p class="text-gray-600 bangla-text">সব কবিতার তালিকা এবং ব্যবস্থাপনা</p>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('admin.posts.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded bangla-text">
                    <i class="fas fa-plus mr-2"></i>নতুন কবিতা (অ্যাডমিন)
                </a>
                <a href="{{ route('posts.create') }}"
                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded bangla-text">
                    <i class="fas fa-user-plus mr-2"></i>নিজের কবিতা
                </a>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white shadow rounded-lg p-6">
            <form method="GET" action="{{ route('admin.posts') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                            খুঁজুন
                        </label>
                        <input type="text" id="search" name="search" value="{{ request('search') }}"
                            placeholder="কবিতার শিরোনাম খুঁজুন"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bangla-text">
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                            অবস্থা
                        </label>
                        <select id="status" name="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">সব কবিতা</option>
                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>প্রকাশিত
                            </option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>খসড়া</option>
                        </select>
                    </div>
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                            বিভাগ
                        </label>
                        <select id="category" name="category"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">সব বিভাগ</option>
                            @foreach (\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name_bangla ?? $category->name }}
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

        <!-- Poems Table -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
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
                                কবিতা
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bangla-text">
                                লেখক
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bangla-text">
                                বিভাগ
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bangla-text">
                                স্ট্যাটাস
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bangla-text">
                                প্রকাশের তারিখ
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bangla-text">
                                ক্রিয়া
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($poems as $poem)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex-1 min-w-0">
                                        <div class="text-sm font-medium text-gray-900 bangla-text">
                                            {{ $poem->title_bangla ?? $poem->title }}
                                        </div>
                                        @if ($poem->title_bangla && $poem->title !== $poem->title_bangla)
                                            <div class="text-sm text-gray-500">
                                                {{ $poem->title }}
                                            </div>
                                        @endif
                                        <div class="text-xs text-gray-500 mt-1">
                                            {{ Str::limit(strip_tags($poem->content_bangla ?? $poem->content), 100) }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                                            <span
                                                class="text-sm font-medium text-gray-700">{{ substr($poem->user->name, 0, 1) }}</span>
                                        </div>
                                        <div class="text-sm text-gray-900 bangla-text">
                                            {{ $poem->user->name_bangla ?? $poem->user->name }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 bangla-text">
                                        {{ $poem->category->name_bangla ?? $poem->category->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $poem->is_published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }} bangla-text">
                                        {{ $poem->is_published ? 'প্রকাশিত' : 'খসড়া' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $poem->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('posts.show', $poem) }}"
                                            class="text-indigo-600 hover:text-indigo-900 bangla-text" title="দেখুন">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('posts.edit', $poem) }}"
                                            class="text-yellow-600 hover:text-yellow-900 bangla-text" title="সম্পাদনা">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('posts.destroy', $poem) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 bangla-text"
                                                title="মুছুন"
                                                onclick="return confirm('আপনি কি নিশ্চিত যে আপনি এই কবিতাটি মুছে ফেলতে চান?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="text-gray-500 bangla-text">
                                        <i class="fas fa-book text-4xl mb-4"></i>
                                        <p class="text-lg font-medium">কোন কবিতা পাওয়া যায়নি</p>
                                        <p class="text-sm">এখনো কোন কবিতা প্রকাশিত হয়নি।</p>
                                        <div class="mt-4 space-x-2">
                                            <a href="{{ route('admin.posts.create') }}"
                                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 bangla-text">
                                                প্রথম কবিতা লিখুন (অ্যাডমিন)
                                            </a>
                                            <a href="{{ route('posts.create') }}"
                                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 bangla-text">
                                                নিজের কবিতা
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
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
    </div>
@endsection
