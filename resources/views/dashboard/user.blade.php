@extends('layouts.bangla-app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Welcome Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 bangla-text">
                    স্বাগতম, {{ auth()->user()->name_bangla ?? auth()->user()->name }}!
                </h1>
                <p class="text-gray-600 bangla-text mt-2">
                    আপনার কবিতার আসরে আপনার ব্যক্তিগত ড্যাশবোর্ড
                </p>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('poems.create') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded bangla-text">
                    নতুন কবিতা লিখুন
                </a>
                <a href="{{ route('profile.edit') }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded bangla-text">
                    প্রোফাইল সম্পাদনা
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 bangla-text">মোট কবিতা</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalPoemsCount }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 bangla-text">প্রকাশিত কবিতা</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $publishedPoemsCount }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600 bangla-text">এই মাসে</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $recentPoemsCount }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Poems -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-gray-900 bangla-text">আপনার সাম্প্রতিক কবিতা</h2>
            <a href="{{ route('poems.create') }}" class="text-blue-600 hover:text-blue-800 bangla-text">
                নতুন কবিতা লিখুন
            </a>
        </div>

        @if($poems->count() > 0)
            <div class="space-y-4">
                @foreach($poems as $poem)
                    <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-900 bangla-text">
                                    {{ $poem->title_bangla }}
                                </h3>
                                @if($poem->title_english)
                                    <p class="text-sm text-gray-600">{{ $poem->title_english }}</p>
                                @endif
                                <div class="flex items-center space-x-4 mt-2">
                                    <span class="text-sm text-gray-500 bangla-text">
                                        {{ $poem->created_at->format('d M Y') }}
                                    </span>
                                    @if($poem->category)
                                        <span class="text-sm text-blue-600 bangla-text">
                                            {{ $poem->category->name_bangla }}
                                        </span>
                                    @endif
                                    <span class="text-sm {{ $poem->is_published ? 'text-green-600' : 'text-yellow-600' }} bangla-text">
                                        {{ $poem->is_published ? 'প্রকাশিত' : 'খসড়া' }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('poems.show', $poem) }}" 
                                   class="text-blue-600 hover:text-blue-800 text-sm bangla-text">
                                    দেখুন
                                </a>
                                <a href="{{ route('poems.edit', $poem) }}" 
                                   class="text-green-600 hover:text-green-800 text-sm bangla-text">
                                    সম্পাদনা
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $poems->links() }}
            </div>
        @else
            <div class="text-center py-8">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900 bangla-text">কোন কবিতা নেই</h3>
                <p class="mt-1 text-sm text-gray-500 bangla-text">আপনার প্রথম কবিতা লিখতে শুরু করুন।</p>
                <div class="mt-6">
                    <a href="{{ route('poems.create') }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 bangla-text">
                        নতুন কবিতা লিখুন
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
