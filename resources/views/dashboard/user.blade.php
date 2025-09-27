@extends('layouts.bangla-app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Welcome Header -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg p-8 mb-8 text-white">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4 bangla-text">
                    স্বাগতম, {{ auth()->user()->name_bangla ?? auth()->user()->name }}!
                </h1>
                <p class="text-xl mb-6 bangla-text">
                    আপনার পোস্টের জগতে স্বাগতম
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('posts.create') }}"
                        class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300 bangla-text">
                        নতুন পোস্ট লিখুন
                    </a>
                    <a href="{{ route('posts.index') }}"
                        class="bg-transparent border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-300 bangla-text">
                        সব পোস্ট দেখুন
                    </a>
                </div>
            </div>
        </div>

        <!-- User Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-book-open text-white"></i>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate bangla-text">আপনার পোস্ট</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ auth()->user()->poems()->count() }}</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-eye text-white"></i>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate bangla-text">মোট ভিউ</dt>
                            <dd class="text-lg font-medium text-gray-900">0</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-heart text-white"></i>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate bangla-text">পছন্দ</dt>
                            <dd class="text-lg font-medium text-gray-900">0</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Poems -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- My Recent Poems -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 bangla-text">আপনার সাম্প্রতিক পোস্ট</h3>
                    <a href="{{ route('posts.index') }}" class="text-sm text-blue-600 hover:text-blue-800 bangla-text">সব
                        দেখুন</a>
                </div>
                <div class="space-y-3">
                    @forelse(auth()->user()->poems()->latest()->limit(5)->get() as $poem)
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
                                    <a href="{{ route('posts.show', $poem) }}"
                                        class="text-blue-600 hover:text-blue-800 text-xs bangla-text">দেখুন</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <i class="fas fa-book text-4xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500 bangla-text">আপনার এখনো কোন পোস্ট নেই</p>
                            <a href="{{ route('posts.create') }}"
                                class="text-blue-600 hover:text-blue-800 bangla-text">প্রথম পোস্ট লিখুন</a>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Popular Poems -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 bangla-text">জনপ্রিয় পোস্ট</h3>
                    <a href="{{ route('posts.index') }}" class="text-sm text-blue-600 hover:text-blue-800 bangla-text">সব
                        দেখুন</a>
                </div>
                <div class="space-y-3">
                    @forelse(\App\Models\Poem::with('user')->where('is_published', true)->latest()->limit(5)->get() as $poem)
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-star text-green-600 text-sm"></i>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 bangla-text">
                                    {{ $poem->title_bangla ?? $poem->title }}</p>
                                <p class="text-xs text-gray-500 bangla-text">লেখক:
                                    {{ $poem->user->name_bangla ?? $poem->user->name }}</p>
                                <div class="flex items-center space-x-2 mt-1">
                                    <span class="text-xs text-gray-500">{{ $poem->created_at->diffForHumans() }}</span>
                                    <a href="{{ route('posts.show', $poem) }}"
                                        class="text-blue-600 hover:text-blue-800 text-xs bangla-text">পড়ুন</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <i class="fas fa-star text-4xl text-gray-300 mb-4"></i>
                            <p class="text-gray-500 bangla-text">কোন পোস্ট পাওয়া যায়নি</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mt-8 bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4 bangla-text">দ্রুত কাজ</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <a href="{{ route('posts.create') }}"
                    class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-plus text-blue-600"></i>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900 bangla-text">নতুন পোস্ট</h4>
                        <p class="text-sm text-gray-500 bangla-text">পোস্ট লিখুন</p>
                    </div>
                </a>

                <a href="{{ route('posts.index') }}"
                    class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-book text-green-600"></i>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900 bangla-text">সব পোস্ট</h4>
                        <p class="text-sm text-gray-500 bangla-text">পোস্ট দেখুন</p>
                    </div>
                </a>

                <a href="{{ route('profile.edit') }}"
                    class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-user text-purple-600"></i>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900 bangla-text">প্রোফাইল</h4>
                        <p class="text-sm text-gray-500 bangla-text">প্রোফাইল সম্পাদনা</p>
                    </div>
                </a>

                <a href="{{ route('posts.index') }}"
                    class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-search text-yellow-600"></i>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900 bangla-text">খুঁজুন</h4>
                        <p class="text-sm text-gray-500 bangla-text">পোস্ট খুঁজুন</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
