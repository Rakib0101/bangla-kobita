@extends('layouts.admin')

@section('title', 'Test Page')
@section('page-title', 'টেস্ট পেজ')

@section('content')
    <div class="space-y-6">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-900 bangla-text">টেস্ট পেজ</h1>
            <p class="text-gray-600 bangla-text">এই পেজটি কাজ করছে কিনা দেখার জন্য।</p>

            <div class="mt-4">
                <h2 class="text-lg font-semibold text-gray-900 bangla-text">ডেটা টেস্ট:</h2>
                <p class="text-sm text-gray-600">কবিতার সংখ্যা: {{ \App\Models\Poem::count() }}</p>
                <p class="text-sm text-gray-600">ইউজারের সংখ্যা: {{ \App\Models\User::count() }}</p>
                <p class="text-sm text-gray-600">বিভাগের সংখ্যা: {{ \App\Models\Category::count() }}</p>
            </div>
        </div>
    </div>
@endsection
