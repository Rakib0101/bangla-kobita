@extends('layouts.bangla-app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg p-8 mb-8 text-white">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4 bangla-text">
                বাংলা কবিতার আসর
            </h1>
            <p class="text-xl md:text-2xl mb-6 bangla-text">
                কবিতা পড়ুন, লিখুন এবং ভাগ করুন
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('poems.index') }}" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300 bangla-text">
                    কবিতা পড়ুন
                </a>
                @auth
                    <a href="{{ route('poems.create') }}" class="bg-transparent border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-300 bangla-text">
                        কবিতা লিখুন
                    </a>
                @else
                    <a href="{{ route('register') }}" class="bg-transparent border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-300 bangla-text">
                        সদস্য হন
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Featured Poems -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold mb-6 bangla-text">বিশেষ কবিতা</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @for($i = 1; $i <= 6; $i++)
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300">
                <div class="mb-4">
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded bangla-text">
                        প্রেমের কবিতা
                    </span>
                </div>
                <h3 class="text-xl font-semibold mb-3 bangla-text">
                    কবিতার শিরোনাম {{ $i }}
                </h3>
                <p class="text-gray-600 mb-4 bangla-text">
                    কবিতার প্রথম কয়েকটি লাইন এখানে থাকবে। এটি একটি নমুনা কবিতা যেখানে আমরা দেখতে পারি কিভাবে কবিতা প্রদর্শিত হবে...
                </p>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500 bangla-text">রবীন্দ্রনাথ ঠাকুর</span>
                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium bangla-text">
                        পড়ুন →
                    </a>
                </div>
            </div>
            @endfor
        </div>
    </div>

    <!-- Categories -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold mb-6 bangla-text">কবিতার বিভাগ</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @for($i = 1; $i <= 8; $i++)
            <div class="bg-white rounded-lg shadow-md p-4 text-center hover:shadow-lg transition duration-300 cursor-pointer">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-sm bangla-text">বিভাগ {{ $i }}</h3>
            </div>
            @endfor
        </div>
    </div>

    <!-- Featured Poets -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold mb-6 bangla-text">বিশেষ কবি</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @for($i = 1; $i <= 4; $i++)
            <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition duration-300">
                <div class="w-20 h-20 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <svg class="w-10 h-10 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-2 bangla-text">কবির নাম {{ $i }}</h3>
                <p class="text-sm text-gray-600 mb-4 bangla-text">
                    কবির সংক্ষিপ্ত পরিচয় এখানে থাকবে
                </p>
                <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium bangla-text">
                    কবিতা দেখুন
                </a>
            </div>
            @endfor
        </div>
    </div>

    <!-- Statistics -->
    <div class="bg-white rounded-lg shadow-md p-8">
        <h2 class="text-3xl font-bold mb-6 text-center bangla-text">আমাদের পরিসংখ্যান</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-center">
            <div>
                <div class="text-4xl font-bold text-blue-600 mb-2">১,২৩৪</div>
                <div class="text-gray-600 bangla-text">কবিতা</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-green-600 mb-2">৫৬৭</div>
                <div class="text-gray-600 bangla-text">কবি</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-purple-600 mb-2">৮৯০</div>
                <div class="text-gray-600 bangla-text">সদস্য</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-orange-600 mb-2">২,৩৪৫</div>
                <div class="text-gray-600 bangla-text">পড়া</div>
            </div>
        </div>
    </div>
</div>
@endsection
