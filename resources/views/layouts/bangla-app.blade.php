<!DOCTYPE html>
<html lang="bn" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'বাংলা কবিতা' }} - বাংলা কবিতার আসর</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Kalpurush:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/keyboard-switcher.js'])

    <!-- Bangla Font Support -->
    <style>
        body {
            font-family: 'Kalpurush', 'SolaimanLipi', 'Bangla', 'Noto Sans Bengali', sans-serif;
        }

        .bangla-text {
            font-family: 'Kalpurush', 'SolaimanLipi', 'Bangla', 'Noto Sans Bengali', sans-serif;
            direction: ltr;
            unicode-bidi: bidi-override;
        }

        .english-text {
            font-family: 'Arial', 'Helvetica', sans-serif;
        }

        /* Keyboard Switcher Styles */
        .keyboard-avro,
        .keyboard-unijoy {
            font-family: 'Kalpurush', 'SolaimanLipi', 'Bangla', 'Noto Sans Bengali', sans-serif !important;
            direction: ltr;
            unicode-bidi: bidi-override;
            font-size: 16px !important;
        }

        .keyboard-english {
            font-family: 'Arial', 'Helvetica', sans-serif !important;
            font-size: 16px !important;
        }

        .bangla-input {
            font-size: 16px;
            padding: 12px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .bangla-input:focus {
            border-color: #3b82f6;
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* Visual feedback for keyboard switching */
        .bangla-input.keyboard-avro {
            border-left: 4px solid #10B981;
            background-color: #f0fdf4;
            border-color: #10B981;
        }

        .bangla-input.keyboard-unijoy {
            border-left: 4px solid #3B82F6;
            background-color: #eff6ff;
            border-color: #3B82F6;
        }

        .bangla-input.keyboard-english {
            border-left: 4px solid #6B7280;
            background-color: #f9fafb;
            border-color: #6B7280;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen"
        style="background-image: radial-gradient(circle at 20% 50%, rgba(120, 119, 198, 0.1) 0%, transparent 50%), radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.1) 0%, transparent 50%), radial-gradient(circle at 40% 80%, rgba(120, 219, 255, 0.1) 0%, transparent 50%);">
        <!-- Top Header -->
        <div class="bg-gray-100 py-2">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <!-- Logo and Site Title -->
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center">
                            <span class="text-3xl font-bold text-teal-600 bangla-text">বাংলা</span>
                            <span class="text-3xl font-bold text-red-700 bangla-text ml-1">কবিতা</span>
                        </a>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600 bangla-text">কবি ও কবিতার ওয়েবসাইট</p>
                        </div>
                    </div>

                    <!-- Right side utilities -->
                    <div class="flex items-center space-x-6">
                        @auth
                            <!-- User Account Section -->
                            <div class="flex items-center space-x-4">
                                <!-- User Profile Link -->
                                <a href="{{ route('dashboard') }}"
                                    class="flex items-center text-teal-600 hover:text-teal-700 bangla-text">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    আপনার পাতা
                                </a>

                                <!-- Logout Button -->
                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center text-red-600 hover:text-red-700 bangla-text">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                            </path>
                                        </svg>
                                        লগ আউট
                                    </button>
                                </form>
                            </div>
                        @else
                            <!-- Registration -->
                            <a href="{{ route('register') }}"
                                class="flex items-center text-teal-600 hover:text-teal-700 bangla-text">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                রেজিস্ট্রেশন
                            </a>

                            <!-- Login -->
                            <a href="{{ route('login') }}"
                                class="flex items-center text-teal-600 hover:text-teal-700 bangla-text">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                                লগ ইন
                            </a>
                        @endauth

                        <!-- Social Media Icons -->
                        <div class="flex items-center space-x-3">
                            <a href="#"
                                class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700">
                                <span class="text-white text-sm font-bold">f</span>
                            </a>
                            <a href="#"
                                class="w-8 h-8 bg-blue-500 rounded flex items-center justify-center hover:bg-blue-600">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="w-8 h-8 bg-red-600 rounded flex items-center justify-center hover:bg-red-700">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Navigation -->
        <nav class="bg-gradient-to-r from-teal-700 to-red-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-12">
                    <!-- Left side navigation -->
                    <div class="flex items-center space-x-8">
                        <!-- Home Icon -->
                        <a href="{{ route('home') }}" class="text-white hover:text-gray-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                        </a>

                        <!-- Navigation Links -->
                        <a href="{{ route('poets.index') }}"
                            class="text-white hover:text-gray-200 text-sm font-medium bangla-text">
                            খ্যাতিমান কবি
                        </a>
                        <a href="{{ route('poems.index') }}"
                            class="text-white hover:text-gray-200 text-sm font-medium bangla-text">
                            কবিতার আসর
                        </a>
                        <a href="#" class="text-white hover:text-gray-200 text-sm font-medium bangla-text">
                            আবৃত্তি
                        </a>
                        <a href="#" class="text-white hover:text-gray-200 text-sm font-medium bangla-text">
                            আলোচনা
                        </a>
                    </div>

                    <!-- Right side - Date -->
                    <div class="text-white text-sm bangla-text">
                        @php
                            $banglaMonths = [
                                'জানুয়ারি',
                                'ফেব্রুয়ারি',
                                'মার্চ',
                                'এপ্রিল',
                                'মে',
                                'জুন',
                                'জুলাই',
                                'আগস্ট',
                                'সেপ্টেম্বর',
                                'অক্টোবর',
                                'নভেম্বর',
                                'ডিসেম্বর',
                            ];
                            $currentMonth = $banglaMonths[date('n') - 1];
                        @endphp
                        আজ {{ date('j') }} {{ $currentMonth }} {{ date('Y') }}
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="py-6">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold mb-4 bangla-text">বাংলা কবিতা</h3>
                        <p class="text-gray-300 bangla-text">
                            বাংলা কবিতার একটি অনলাইন প্ল্যাটফর্ম যেখানে কবি ও কবিতা প্রেমীরা মিলিত হতে পারেন।
                        </p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4 bangla-text">লিংক</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('home') }}"
                                    class="text-gray-300 hover:text-white bangla-text">হোম</a></li>
                            <li><a href="{{ route('poems.index') }}"
                                    class="text-gray-300 hover:text-white bangla-text">কবিতা</a></li>
                            <li><a href="{{ route('poets.index') }}"
                                    class="text-gray-300 hover:text-white bangla-text">কবি</a></li>
                            <li><a href="{{ route('categories.index') }}"
                                    class="text-gray-300 hover:text-white bangla-text">বিভাগ</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4 bangla-text">যোগাযোগ</h3>
                        <p class="text-gray-300 bangla-text">
                            আমাদের সাথে যোগাযোগ করুন
                        </p>
                    </div>
                </div>
                <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                    <p class="text-gray-300 bangla-text">
                        © {{ date('Y') }} বাংলা কবিতা। সকল অধিকার সংরক্ষিত।
                    </p>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
