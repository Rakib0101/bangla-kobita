@extends('layouts.admin')

@section('title', 'Categories Management')
@section('page-title', 'বিভাগ ম্যানেজমেন্ট')

@section('content')
    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 bangla-text">বিভাগ তালিকা</h2>
                <p class="text-gray-600 bangla-text">সব বিভাগের তালিকা এবং ব্যবস্থাপনা</p>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('admin.categories.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded bangla-text">
                    <i class="fas fa-plus mr-2"></i>নতুন বিভাগ
                </a>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white shadow rounded-lg p-6">
            <form method="GET" action="{{ route('admin.categories') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                            খুঁজুন
                        </label>
                        <input type="text" id="search" name="search" value="{{ request('search') }}"
                            placeholder="বিভাগের নাম খুঁজুন"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bangla-text">
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                            অবস্থা
                        </label>
                        <select id="status" name="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">সব অবস্থা</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>সক্রিয়</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>নিষ্ক্রিয়
                            </option>
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

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($categories as $category)
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 bangla-text">
                            {{ $category->name_bangla ?? $category->name }}
                        </h3>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                            {{ $category->poems_count }} কবিতা
                        </span>
                    </div>

                    @if ($category->name_bangla && $category->name !== $category->name_bangla)
                        <p class="text-sm text-gray-600 mb-4">
                            {{ $category->name }}
                        </p>
                    @endif

                    @if ($category->description_bangla || $category->description)
                        <p class="text-sm text-gray-700 mb-4 bangla-text">
                            {{ $category->description_bangla ?? $category->description }}
                        </p>
                    @endif

                    <div class="flex items-center justify-between">
                        <div class="text-xs text-gray-500">
                            {{ $category->created_at->format('d M Y') }}
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.categories.edit', $category) }}"
                                class="text-yellow-600 hover:text-yellow-900 text-sm bangla-text">
                                সম্পাদনা
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm bangla-text"
                                    onclick="return confirm('আপনি কি নিশ্চিত যে আপনি এই বিভাগটি মুছে ফেলতে চান?')">
                                    মুছুন
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $categories->links() }}
        </div>
    </div>
@endsection
