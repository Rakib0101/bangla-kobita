@extends('layouts.bangla-app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold mb-4 bangla-text">কবিতার বিভাগ</h1>
        <p class="text-lg text-gray-600 bangla-text">বিভিন্ন বিষয়ের উপর লেখা কবিতা</p>
    </div>

    <!-- Categories Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach(\App\Models\Category::where('is_active', true)->orderBy('sort_order')->get() as $category)
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 rounded-full flex items-center justify-center mr-4" style="background-color: {{ $category->color }}20;">
                    <div class="w-6 h-6 rounded-full" style="background-color: {{ $category->color }};"></div>
                </div>
                <div>
                    <h3 class="text-xl font-semibold bangla-text">{{ $category->name_bangla }}</h3>
                    <p class="text-sm text-gray-600 english-text">{{ $category->name_english }}</p>
                </div>
            </div>
            
            <p class="text-gray-600 mb-4 bangla-text">
                {{ $category->description_bangla }}
            </p>
            
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-500 bangla-text">
                    {{ rand(10, 100) }}টি কবিতা
                </span>
                <a href="#" class="text-blue-600 hover:text-blue-800 font-medium bangla-text">
                    দেখুন →
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Popular Tags -->
    <div class="mt-12">
        <h2 class="text-2xl font-bold mb-6 bangla-text">জনপ্রিয় ট্যাগ</h2>
        <div class="flex flex-wrap gap-2">
            @php
                $tags = ['প্রেম', 'জীবন', 'প্রকৃতি', 'দেশপ্রেম', 'মা', 'বাবা', 'বন্ধু', 'স্মৃতি', 'বেদনা', 'আনন্দ', 'স্বপ্ন', 'বাস্তবতা', 'সময়', 'মৃত্যু', 'জন্ম', 'বিবাহ', 'বিচ্ছেদ', 'মিলন', 'ভালোবাসা', 'ঘৃণা'];
            @endphp
            @foreach($tags as $tag)
            <span class="inline-block bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded-full hover:bg-gray-200 cursor-pointer bangla-text">
                {{ $tag }}
            </span>
            @endforeach
        </div>
    </div>
</div>
@endsection
