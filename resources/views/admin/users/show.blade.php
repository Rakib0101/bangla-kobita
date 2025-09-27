@extends('layouts.admin')

@section('title', 'User Details')
@section('page-title', 'ইউজার বিস্তারিত')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- User Header -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-gray-300 rounded-full flex items-center justify-center">
                        <span class="text-2xl font-bold text-gray-700">{{ substr($user->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 bangla-text">{{ $user->name_bangla ?? $user->name }}</h1>
                        @if ($user->name_bangla && $user->name !== $user->name_bangla)
                            <p class="text-lg text-gray-600">{{ $user->name }}</p>
                        @endif
                        <p class="text-gray-500">{{ $user->email }}</p>
                    </div>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('admin.users.edit', $user) }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded bangla-text">
                        <i class="fas fa-edit mr-2"></i>সম্পাদনা
                    </a>
                    <a href="{{ route('admin.users') }}"
                        class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded bangla-text">
                        <i class="fas fa-arrow-left mr-2"></i>ফিরে যান
                    </a>
                </div>
            </div>
        </div>

        <!-- User Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-book-open text-white"></i>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate bangla-text">মোট কবিতা</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $user->poems()->count() }}</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-check-circle text-white"></i>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate bangla-text">প্রকাশিত কবিতা</dt>
                            <dd class="text-lg font-medium text-gray-900">
                                {{ $user->poems()->where('is_published', true)->count() }}</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-edit text-white"></i>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate bangla-text">খসড়া কবিতা</dt>
                            <dd class="text-lg font-medium text-gray-900">
                                {{ $user->poems()->where('is_published', false)->count() }}</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-calendar text-white"></i>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate bangla-text">যোগদানের তারিখ</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $user->created_at->format('d M Y') }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Information -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Basic Information -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4 bangla-text">মূল তথ্য</h3>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500 bangla-text">নাম (বাংলা)</dt>
                        <dd class="text-sm text-gray-900 bangla-text">{{ $user->name_bangla ?? 'নির্ধারিত হয়নি' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">নাম (English)</dt>
                        <dd class="text-sm text-gray-900">{{ $user->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">ইমেইল</dt>
                        <dd class="text-sm text-gray-900">{{ $user->email }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 bangla-text">ভূমিকা</dt>
                        <dd class="text-sm">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }} bangla-text">
                                {{ $user->role === 'admin' ? 'অ্যাডমিন' : 'ইউজার' }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500 bangla-text">অবস্থা</dt>
                        <dd class="text-sm">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} bangla-text">
                                {{ $user->is_active ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}
                            </span>
                        </dd>
                    </div>
                </dl>
            </div>

            <!-- Recent Poems -->
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 bangla-text">সাম্প্রতিক কবিতা</h3>
                    <a href="{{ route('admin.posts') }}" class="text-sm text-blue-600 hover:text-blue-800 bangla-text">সব
                        দেখুন</a>
                </div>
                <div class="space-y-3">
                    @forelse($recentPoems as $poem)
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-book text-blue-600 text-sm"></i>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 bangla-text">
                                    {{ $poem->title_bangla ?? $poem->title }}</p>
                                <p class="text-xs text-gray-500">{{ $poem->created_at->diffForHumans() }}</p>
                                <div class="flex items-center space-x-2 mt-1">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $poem->is_published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $poem->is_published ? 'প্রকাশিত' : 'খসড়া' }}
                                    </span>
                                    @if ($poem->category)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 bangla-text">
                                            {{ $poem->category->name_bangla ?? $poem->category->name }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <i class="fas fa-book text-4xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500 bangla-text">কোন কবিতা নেই</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
