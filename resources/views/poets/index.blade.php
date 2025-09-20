@extends('layouts.bangla-app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold mb-4 bangla-text">কবি সংগ্রহ</h1>
        <p class="text-lg text-gray-600 bangla-text">বাংলা সাহিত্যের বিখ্যাত কবিদের পরিচিতি</p>
    </div>

    <!-- Featured Poets -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold mb-6 bangla-text">বিশেষ কবি</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach(\App\Models\Poet::where('is_featured', true)->where('is_active', true)->orderBy('sort_order')->get() as $poet)
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300">
                <div class="text-center">
                    <div class="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 bangla-text">{{ $poet->name_bangla }}</h3>
                    <p class="text-sm text-gray-600 mb-3 english-text">{{ $poet->name_english }}</p>
                    <p class="text-sm text-gray-600 mb-4 bangla-text">
                        {{ Str::limit($poet->biography_bangla, 100) }}
                    </p>
                    <div class="text-xs text-gray-500 mb-4 bangla-text">
                        জন্ম: {{ $poet->birth_date ? $poet->birth_date->format('d M Y') : 'অজানা' }}
                        @if($poet->death_date)
                            | মৃত্যু: {{ $poet->death_date->format('d M Y') }}
                        @endif
                    </div>
                    <a href="#" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm bangla-text">
                        কবিতা দেখুন
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- All Poets -->
    <div>
        <h2 class="text-2xl font-bold mb-6 bangla-text">সব কবি</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach(\App\Models\Poet::where('is_active', true)->orderBy('sort_order')->get() as $poet)
            <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition duration-300">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gray-200 rounded-full mx-auto mb-3 flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-1 bangla-text">{{ $poet->name_bangla }}</h3>
                    <p class="text-xs text-gray-600 mb-2 english-text">{{ $poet->name_english }}</p>
                    <div class="text-xs text-gray-500 mb-3 bangla-text">
                        {{ $poet->birth_date ? $poet->birth_date->format('Y') : 'অজানা' }}
                        @if($poet->death_date)
                            - {{ $poet->death_date->format('Y') }}
                        @endif
                    </div>
                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm bangla-text">
                        কবিতা দেখুন
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
