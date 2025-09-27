@extends('layouts.bangla-app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Admin Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 bangla-text">
                        প্রশাসক ড্যাশবোর্ড
                    </h1>
                    <p class="text-gray-600 bangla-text mt-2">
                        সাইটের সামগ্রিক পরিসংখ্যান ও ব্যবস্থাপনা
                    </p>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('admin.users') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded bangla-text">
                        ব্যবহারকারী ব্যবস্থাপনা
                    </a>
                    <a href="{{ route('admin.posts') }}"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded bangla-text">
                        কবিতা ব্যবস্থাপনা
                    </a>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 bangla-text">মোট ব্যবহারকারী</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 bangla-text">সক্রিয় ব্যবহারকারী</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $activeUsers }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 bangla-text">মোট কবিতা</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $totalPoems }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 bangla-text">প্রকাশিত কবিতা</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $publishedPoems }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 bangla-text">বিভাগ</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $totalCategories }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-100 text-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600 bangla-text">লেখক</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $totalPoets }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Users -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-900 bangla-text mb-4">সাম্প্রতিক ব্যবহারকারী</h2>
                <div class="space-y-3">
                    @foreach ($recentUsers as $user)
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-medium text-gray-700">
                                        {{ substr($user->name_bangla ?? $user->name, 0, 1) }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 bangla-text">
                                    {{ $user->name_bangla ?? $user->name }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ $user->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <div class="flex-shrink-0">
                                <span
                                    class="text-xs {{ $user->is_active ? 'text-green-600' : 'text-red-600' }} bangla-text">
                                    {{ $user->is_active ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Recent Poems -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-900 bangla-text mb-4">সাম্প্রতিক কবিতা</h2>
                <div class="space-y-3">
                    @foreach ($recentPoems as $poem)
                        <div class="border-l-4 border-blue-500 pl-4">
                            <p class="text-sm font-medium text-gray-900 bangla-text">
                                {{ $poem->title_bangla }}
                            </p>
                            <p class="text-xs text-gray-500">
                                {{ $poem->user->name_bangla ?? $poem->user->name }} -
                                {{ $poem->created_at->diffForHumans() }}
                            </p>
                            <span
                                class="text-xs {{ $poem->is_published ? 'text-green-600' : 'text-yellow-600' }} bangla-text">
                                {{ $poem->is_published ? 'প্রকাশিত' : 'খসড়া' }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Pending Poems -->
        @if ($pendingPoems->count() > 0)
            <div class="bg-white rounded-lg shadow-md p-6 mt-6">
                <h2 class="text-xl font-semibold text-gray-900 bangla-text mb-4">অনুমোদনের জন্য অপেক্ষমান কবিতা</h2>
                <div class="space-y-4">
                    @foreach ($pendingPoems as $poem)
                        <div class="border border-yellow-200 rounded-lg p-4 bg-yellow-50">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <h3 class="text-lg font-medium text-gray-900 bangla-text">
                                        {{ $poem->title_bangla }}
                                    </h3>
                                    <p class="text-sm text-gray-600">
                                        {{ $poem->user->name_bangla ?? $poem->user->name }} -
                                        {{ $poem->created_at->format('d M Y') }}
                                    </p>
                                </div>
                                <div class="flex space-x-2">
                                    <button
                                        class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm bangla-text">
                                        অনুমোদন
                                    </button>
                                    <button
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm bangla-text">
                                        প্রত্যাখ্যান
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
