@extends('layouts.bangla-app')

@section('content')
    <div class="max-w-7xl mx-auto">

        <!-- Image Banner Slider Section -->
        <div class="relative w-full h-auto mb-8 overflow-hidden">
            <!-- Slider Container -->
            <div class="flex transition-transform duration-500 h-auto" id="slider">
                <!-- Slide 1 -->
                <div class="w-full flex-shrink-0 relative">
                    <img src="{{ asset('assets/images/banner.png') }}" alt="Banner 1" class="w-full h-auto object-fill">
                </div>
                <!-- Slide 2 -->
                <div class="w-full flex-shrink-0 relative">
                    <img src="{{ asset('assets/images/banner.png') }}" alt="Banner 2" class="w-full h-auto object-fill">
                </div>
                <!-- Slide 3 -->
                <div class="w-full flex-shrink-0 relative">
                    <img src="{{ asset('assets/images/banner.png') }}" alt="Banner 3" class="w-full h-auto object-fill">
                </div>
            </div>

            <!-- Navigation Buttons -->
            <button onclick="moveSlide(-1)"
                class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-75 rounded-full p-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button onclick="moveSlide(1)"
                class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-75 rounded-full p-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Dots Indicator -->
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                <button onclick="goToSlide(0)"
                    class="h-2 w-2 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100"></button>
                <button onclick="goToSlide(1)"
                    class="h-2 w-2 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100"></button>
                <button onclick="goToSlide(2)"
                    class="h-2 w-2 rounded-full bg-white bg-opacity-50 hover:bg-opacity-100"></button>
            </div>
        </div>

        <script>
            let currentSlide = 0;
            const slides = document.querySelectorAll('#slider > div');
            const slider = document.querySelector('#slider');
            const dots = document.querySelectorAll('.absolute.bottom-4 button');

            function updateSlider() {
                slider.style.transform = `translateX(-${currentSlide * 100}%)`;
                // Update dots
                dots.forEach((dot, index) => {
                    dot.classList.toggle('bg-opacity-100', index === currentSlide);
                    dot.classList.toggle('bg-opacity-50', index !== currentSlide);
                });
            }

            function moveSlide(direction) {
                currentSlide = (currentSlide + direction + slides.length) % slides.length;
                updateSlider();
            }

            function goToSlide(slideIndex) {
                currentSlide = slideIndex;
                updateSlider();
            }

            // Auto-advance slides every 5 seconds
            setInterval(() => moveSlide(1), 5000);

            // Initial update
            updateSlider();
        </script>
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
                    <a href="{{ route('posts.index') }}"
                        class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300 bangla-text">
                        কবিতা পড়ুন
                    </a>
                    @auth
                        <a href="{{ route('posts.create') }}"
                            class="bg-transparent border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-300 bangla-text">
                            কবিতা লিখুন
                        </a>
                    @else
                        <a href="{{ route('register') }}"
                            class="bg-transparent border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-300 bangla-text">
                            সদস্য হন
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Latest Poems Section -->
        <div class="mb-8 px-4 lg:px-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-3xl font-bold bangla-text">সর্বশেষ কবিতা</h2>
                <a href="{{ route('posts.index') }}" class="text-blue-600 hover:text-blue-800 bangla-text">
                    সব কবিতা দেখুন →
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($latestPoems as $poem)
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-300">
                        <!-- Poem Image -->
                        @if ($poem->image_path)
                            <div class="mb-4">
                                <img src="{{ Storage::url($poem->image_path) }}" alt="{{ $poem->title_bangla }}"
                                    class="w-full h-48 object-cover rounded-lg">
                            </div>
                        @endif

                        <!-- Category Badge -->
                        @if ($poem->category)
                            <div class="mb-4">
                                <span
                                    class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded bangla-text">
                                    {{ $poem->category->name_bangla }}
                                </span>
                            </div>
                        @endif

                        <!-- Poem Title -->
                        <h3 class="text-xl font-semibold mb-3 bangla-text">
                            {{ $poem->title_bangla }}
                        </h3>

                        <!-- Poem Content Preview -->
                        <p class="text-gray-600 mb-4 bangla-text">
                            {{ Str::limit(strip_tags($poem->content_bangla), 120) }}
                        </p>

                        <!-- Author and Date -->
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500 bangla-text">
                                {{ $poem->user->name_bangla ?? $poem->user->name }}
                            </span>
                            <span class="text-xs text-gray-400">{{ $poem->created_at->diffForHumans() }}</span>
                        </div>

                        <!-- Read More Link -->
                        <div class="mt-4">
                            <a href="{{ route('posts.show', $poem) }}"
                                class="text-blue-600 hover:text-blue-800 text-sm font-medium bangla-text">
                                পড়ুন →
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2 bangla-text">কোনো কবিতা পাওয়া যায়নি</h3>
                        <p class="text-gray-500 bangla-text">এখনো কোনো কবিতা প্রকাশিত হয়নি</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Categories -->
        <div class="mb-8 px-4 lg:px-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-3xl font-bold bangla-text">কবিতার বিভাগ</h2>
                <a href="{{ route('categories.index') }}" class="text-blue-600 hover:text-blue-800 bangla-text">
                    সব বিভাগ দেখুন →
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @forelse($categories as $category)
                    <div
                        class="bg-white rounded-lg shadow-md p-4 text-center hover:shadow-lg transition duration-300 cursor-pointer">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-sm bangla-text">{{ $category->name_bangla }}</h3>
                        <p class="text-xs text-gray-500 mt-1">{{ $category->poems_count }}টি কবিতা</p>
                    </div>
                @empty
                    <div class="col-span-full text-center py-8">
                        <p class="text-gray-500 bangla-text">কোনো বিভাগ পাওয়া যায়নি</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Featured Writers -->
        <div class="mb-8 px-4 lg:px-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-3xl font-bold bangla-text">বিশেষ লেখক</h2>
                <a href="{{ route('poets.index') }}" class="text-blue-600 hover:text-blue-800 bangla-text">
                    সব লেখক দেখুন →
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($featuredPoets as $poet)
                    <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition duration-300">
                        <div class="w-20 h-20 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                            @if ($poet->image)
                                <img src="{{ Storage::url($poet->image) }}" alt="{{ $poet->name_bangla }}"
                                    class="w-20 h-20 rounded-full object-cover">
                            @else
                                <svg class="w-10 h-10 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            @endif
                        </div>
                        <h3 class="text-lg font-semibold mb-2 bangla-text">{{ $poet->name_bangla }}</h3>
                        @if ($poet->name_english)
                            <p class="text-sm text-gray-600 mb-2 english-text">{{ $poet->name_english }}</p>
                        @endif
                        <p class="text-sm text-gray-600 mb-4 bangla-text">
                            {{ Str::limit($poet->biography_bangla, 80) }}
                        </p>
                        <a href="{{ route('poets.show', $poet) }}"
                            class="text-blue-600 hover:text-blue-800 text-sm font-medium bangla-text">
                            সব রচনা দেখুন
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center py-8">
                        <p class="text-gray-500 bangla-text">কোনো বিশেষ লেখক পাওয়া যায়নি</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Category-wise Content Sections -->
        <div class="mb-8 px-4 lg:px-8">
            <h2 class="text-3xl font-bold mb-6 text-center bangla-text">বিভিন্ন ধরনের রচনা</h2>

            <!-- Poems Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-2xl font-bold bangla-text text-red-600">কবিতা</h3>
                    <a href="{{ route('posts.index', ['category' => 'kobita']) }}"
                        class="text-blue-600 hover:text-blue-800 bangla-text">
                        সব কবিতা দেখুন →
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($poemsByCategory['kobita'] ?? [] as $poem)
                        <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition duration-300">
                            <h4 class="text-lg font-semibold mb-2 bangla-text">{{ $poem->title_bangla }}</h4>
                            <p class="text-sm text-gray-600 mb-2 bangla-text">লেখক:
                                {{ $poem->user->name_bangla ?? $poem->user->name }}</p>
                            <p class="text-sm text-gray-500 mb-3">{{ Str::limit(strip_tags($poem->content_bangla), 100) }}
                            </p>
                            <a href="{{ route('posts.show', $poem) }}"
                                class="text-blue-600 hover:text-blue-800 text-sm bangla-text">পড়ুন</a>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-8">
                            <p class="text-gray-500 bangla-text">কোন কবিতা পাওয়া যায়নি</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Novels Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-2xl font-bold bangla-text text-green-600">উপন্যাস</h3>
                    <a href="{{ route('posts.index', ['category' => 'uponnas']) }}"
                        class="text-blue-600 hover:text-blue-800 bangla-text">
                        সব উপন্যাস দেখুন →
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($poemsByCategory['uponnas'] ?? [] as $poem)
                        <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition duration-300">
                            <h4 class="text-lg font-semibold mb-2 bangla-text">{{ $poem->title_bangla }}</h4>
                            <p class="text-sm text-gray-600 mb-2 bangla-text">লেখক:
                                {{ $poem->user->name_bangla ?? $poem->user->name }}</p>
                            <p class="text-sm text-gray-500 mb-3">{{ Str::limit(strip_tags($poem->content_bangla), 100) }}
                            </p>
                            <a href="{{ route('posts.show', $poem) }}"
                                class="text-blue-600 hover:text-blue-800 text-sm bangla-text">পড়ুন</a>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-8">
                            <p class="text-gray-500 bangla-text">কোন উপন্যাস পাওয়া যায়নি</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Short Stories Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-2xl font-bold bangla-text text-blue-600">ছোটগল্প</h3>
                    <a href="{{ route('posts.index', ['category' => 'chotogolpo']) }}"
                        class="text-blue-600 hover:text-blue-800 bangla-text">
                        সব গল্প দেখুন →
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($poemsByCategory['chotogolpo'] ?? [] as $poem)
                        <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition duration-300">
                            <h4 class="text-lg font-semibold mb-2 bangla-text">{{ $poem->title_bangla }}</h4>
                            <p class="text-sm text-gray-600 mb-2 bangla-text">লেখক:
                                {{ $poem->user->name_bangla ?? $poem->user->name }}</p>
                            <p class="text-sm text-gray-500 mb-3">{{ Str::limit(strip_tags($poem->content_bangla), 100) }}
                            </p>
                            <a href="{{ route('posts.show', $poem) }}"
                                class="text-blue-600 hover:text-blue-800 text-sm bangla-text">পড়ুন</a>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-8">
                            <p class="text-gray-500 bangla-text">কোন গল্প পাওয়া যায়নি</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Blogs Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-2xl font-bold bangla-text text-purple-600">ব্লগ</h3>
                    <a href="{{ route('posts.index', ['category' => 'blog']) }}"
                        class="text-blue-600 hover:text-blue-800 bangla-text">
                        সব ব্লগ দেখুন →
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($poemsByCategory['blog'] ?? [] as $poem)
                        <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition duration-300">
                            <h4 class="text-lg font-semibold mb-2 bangla-text">{{ $poem->title_bangla }}</h4>
                            <p class="text-sm text-gray-600 mb-2 bangla-text">লেখক:
                                {{ $poem->user->name_bangla ?? $poem->user->name }}</p>
                            <p class="text-sm text-gray-500 mb-3">{{ Str::limit(strip_tags($poem->content_bangla), 100) }}
                            </p>
                            <a href="{{ route('posts.show', $poem) }}"
                                class="text-blue-600 hover:text-blue-800 text-sm bangla-text">পড়ুন</a>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-8">
                            <p class="text-gray-500 bangla-text">কোন ব্লগ পাওয়া যায়নি</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="bg-white rounded-lg shadow-md p-8">
            <h2 class="text-3xl font-bold mb-6 text-center bangla-text">আমাদের পরিসংখ্যান</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-center">
                <div>
                    <div class="text-4xl font-bold text-blue-600 mb-2">{{ number_format($stats['total_poems']) }}</div>
                    <div class="text-gray-600 bangla-text">কবিতা</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-green-600 mb-2">{{ number_format($stats['total_poets']) }}</div>
                    <div class="text-gray-600 bangla-text">কবি</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-purple-600 mb-2">{{ number_format($stats['total_users']) }}</div>
                    <div class="text-gray-600 bangla-text">সদস্য</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-orange-600 mb-2">{{ number_format($stats['total_views']) }}</div>
                    <div class="text-gray-600 bangla-text">পড়া</div>
                </div>
            </div>
        </div>
    </div>
@endsection
