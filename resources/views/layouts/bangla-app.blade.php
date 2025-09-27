<!DOCTYPE html>
<html lang="bn" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>সাহিত্য ক্যানভাস — শব্দের রঙে আঁকা স্বপ্নের জগৎ।</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Kalpurush:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/keyboard-switcher.js'])

    <!-- Additional Head Content -->
    @yield('head')

    <!-- Bangla Font Support -->
    <style>
        /* Custom Font Definitions */
        @font-face {
            font-family: 'AbuJMAkkas';
            src: url('/font/Li Abu J M Akkas Unicode.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'AbuJMAkkas';
            src: url('/font/Li Abu J M Akkas Unicode Italic.ttf') format('truetype');
            font-weight: normal;
            font-style: italic;
            font-display: swap;
        }

        body {
            font-family: 'AbuJMAkkas', 'Kalpurush', 'SolaimanLipi', 'Bangla', 'Noto Sans Bengali', sans-serif;
        }

        .bangla-text {
            font-family: 'AbuJMAkkas', 'Kalpurush', 'SolaimanLipi', 'Bangla', 'Noto Sans Bengali', sans-serif;
            direction: ltr;
            unicode-bidi: bidi-override;
        }

        .english-text {
            font-family: 'Arial', 'Helvetica', sans-serif;
        }

        /* Keyboard Switcher Styles */
        .keyboard-avro,
        .keyboard-unijoy {
            font-family: 'AbuJMAkkas', 'Kalpurush', 'SolaimanLipi', 'Bangla', 'Noto Sans Bengali', sans-serif !important;
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

        /* Additional responsive styles */
        @media (max-width: 640px) {
            .mobile-hidden {
                display: none !important;
            }

            .mobile-text-xs {
                font-size: 0.75rem !important;
            }

            .mobile-compact {
                padding: 0.25rem !important;
            }
        }

        /* Ensure mobile menu appears above other content */
        .mobile-menu {
            z-index: 9999;
        }

        /* Smooth transitions for responsive elements */
        .responsive-transition {
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen max-w-7xl mx-auto shadow-sm"
        style="background-image: radial-gradient(circle at 20% 50%, rgba(120, 119, 198, 0.1) 0%, transparent 50%), radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.1) 0%, transparent 50%), radial-gradient(circle at 40% 80%, rgba(120, 219, 255, 0.1) 0%, transparent 50%);">
        <!-- Top Header -->
        <div class="">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-black py-2">
                <div class="flex justify-between items-center">
                    <!-- Logo and Site Title -->
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center">
                            <span class="text-2xl sm:text-3xl font-bold text-teal-600 bangla-text">বাংলা</span>
                            <span class="text-2xl sm:text-3xl font-bold text-red-700 bangla-text ml-1">কবিতা</span>
                        </a>
                        <div class="ml-2 sm:ml-4 hidden sm:block">
                            <p class="text-xs sm:text-sm text-gray-600 bangla-text">কবি ও কবিতার ওয়েবসাইট</p>
                        </div>
                    </div>

                    <!-- Right side utilities -->
                    <div class="flex items-center space-x-2 sm:space-x-6">
                        @auth
                            <!-- User Account Section -->
                            <div class="flex items-center space-x-2 sm:space-x-4">
                                <!-- User Profile Link -->
                                <a href="{{ route('dashboard') }}"
                                    class="flex items-center text-teal-600 hover:text-teal-700 bangla-text text-sm">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1 sm:mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="hidden sm:inline">আপনার পাতা</span>
                                </a>

                                <!-- Logout Button -->
                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center text-red-600 hover:text-red-700 bangla-text text-sm">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1 sm:mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                            </path>
                                        </svg>
                                        <span class="hidden sm:inline">লগ আউট</span>
                                    </button>
                                </form>
                            </div>
                        @else
                            <!-- Registration -->
                            <a href="{{ route('register') }}"
                                class="flex items-center text-teal-600 hover:text-teal-700 bangla-text text-sm">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="hidden sm:inline">রেজিস্ট্রেশন</span>
                            </a>

                            <!-- Login -->
                            <a href="{{ route('login') }}"
                                class="flex items-center text-teal-600 hover:text-teal-700 bangla-text text-sm">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                                <span class="hidden sm:inline">লগ ইন</span>
                            </a>
                        @endauth

                        <!-- Social Media Icons -->
                        <div class="flex items-center space-x-2 sm:space-x-3">
                            <a href="#"
                                class="w-6 h-6 sm:w-8 sm:h-8 bg-blue-600 rounded-full flex items-center justify-center hover:bg-blue-700">
                                <span class="text-white text-xs sm:text-sm font-bold">f</span>
                            </a>
                            <a href="#"
                                class="w-6 h-6 sm:w-8 sm:h-8 bg-blue-500 rounded flex items-center justify-center hover:bg-blue-600">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="w-6 h-6 sm:w-8 sm:h-8 bg-red-600 rounded flex items-center justify-center hover:bg-red-700">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
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
        <nav class="relative" x-data="{ mobileMenuOpen: false }" @click.outside="mobileMenuOpen = false">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-teal-700 to-red-800">
                <div class="flex items-center justify-between h-12">
                    <!-- Mobile menu button -->
                    <div class="md:hidden">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" type="button"
                            class="text-white hover:text-gray-200 focus:outline-none focus:text-gray-200">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Desktop navigation -->
                    <div class="hidden md:flex items-center space-x-8">
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
                            খ্যাতিমান লেখক
                        </a>
                        <a href="{{ route('posts.index') }}"
                            class="text-white hover:text-gray-200 text-sm font-medium bangla-text">
                            কবিতার আসর
                        </a>
                        @auth
                            <a href="{{ route('adda.index') }}"
                                class="text-white hover:text-gray-200 text-sm font-medium bangla-text">
                                আড্ডা
                            </a>
                        @endauth
                        <a href="#" class="text-white hover:text-gray-200 text-sm font-medium bangla-text">
                            আলোচনা
                        </a>
                    </div>

                    <!-- Right side - Calendar Date -->
                    <div class="flex items-center space-x-2 sm:space-x-4 text-white text-sm">
                        <!-- Calendar Icon -->
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>

                        <!-- Date Display -->
                        <div class="text-center">
                            @php
                                // Bengali Calendar Months
                                $banglaMonths = [
                                    'বৈশাখ',
                                    'জ্যৈষ্ঠ',
                                    'আষাঢ়',
                                    'শ্রাবণ',
                                    'ভাদ্র',
                                    'আশ্বিন',
                                    'কার্তিক',
                                    'অগ্রহায়ণ',
                                    'পৌষ',
                                    'মাঘ',
                                    'ফাল্গুন',
                                    'চৈত্র',
                                ];

                                // Bengali Days
                                $banglaDays = [
                                    'রবিবার',
                                    'সোমবার',
                                    'মঙ্গলবার',
                                    'বুধবার',
                                    'বৃহস্পতিবার',
                                    'শুক্রবার',
                                    'শনিবার',
                                ];

                                // English months for fallback
                                $englishMonths = [
                                    'January',
                                    'February',
                                    'March',
                                    'April',
                                    'May',
                                    'June',
                                    'July',
                                    'August',
                                    'September',
                                    'October',
                                    'November',
                                    'December',
                                ];

                                // Convert English date to Bengali calendar
                                function getBengaliDate($englishDate)
                                {
                                    $banglaMonths = [
                                        'বৈশাখ',
                                        'জ্যৈষ্ঠ',
                                        'আষাঢ়',
                                        'শ্রাবণ',
                                        'ভাদ্র',
                                        'আশ্বিন',
                                        'কার্তিক',
                                        'অগ্রহায়ণ',
                                        'পৌষ',
                                        'মাঘ',
                                        'ফাল্গুন',
                                        'চৈত্র',
                                    ];

                                    // Simple approximation - in real implementation, you'd use proper Bengali calendar conversion
    $month = (int) date('n', $englishDate);
    $day = (int) date('j', $englishDate);
    $year = (int) date('Y', $englishDate);

    // Approximate conversion (this is simplified - real Bengali calendar is more complex)
    $banglaYear = $year - 593; // Approximate year difference
    $banglaMonth = $month - 3; // Approximate month offset
    if ($banglaMonth <= 0) {
        $banglaMonth += 12;
        $banglaYear--;
    }

    return [
        'day' => $day,
        'month' => $banglaMonths[$banglaMonth - 1],
        'year' => $banglaYear,
        'month_num' => $banglaMonth,
    ];
}

$currentDay = $banglaDays[date('w')];
$currentDate = date('j');
$currentYear = date('Y');
$currentMonthName = date('F');

                                $banglaDate = getBengaliDate(time());
                            @endphp

                            <!-- Bengali Calendar Date -->
                            <div class="bangla-text font-medium text-xs sm:text-sm">
                                {{ $currentDay }}, {{ $banglaDate['day'] }} {{ $banglaDate['month'] }}
                                {{ $banglaDate['year'] }}
                            </div>

                            <!-- English Date -->
                            <div class="english-text text-xs opacity-90">
                                {{ $currentDay }}, {{ $currentMonthName }} {{ $currentDate }},
                                {{ $currentYear }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Mobile menu overlay -->
            <div x-show="mobileMenuOpen" x-transition:enter="transition-opacity ease-linear duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-linear duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="md:hidden fixed inset-0 bg-black bg-opacity-25 z-40" @click="mobileMenuOpen = false">
            </div>

            <!-- Mobile menu drawer -->
            <div x-show="mobileMenuOpen" x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-300 transform"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                class="md:hidden fixed top-0 left-0 bottom-0 w-64 bg-gradient-to-b from-teal-700 to-red-800 shadow-xl z-50 overflow-y-auto">

                <!-- Drawer Header -->
                <div class="flex items-center justify-between p-4 border-b border-white border-opacity-20">
                    <div class="flex items-center">
                        <span class="text-xl font-bold text-teal-200 bangla-text">বাংলা</span>
                        <span class="text-xl font-bold text-red-200 bangla-text ml-1">কবিতা</span>
                    </div>
                    <button @click="mobileMenuOpen = false" class="text-white hover:text-gray-200 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Navigation Links -->
                <div class="px-4 py-6 space-y-4">
                    <a href="{{ route('home') }}" @click="mobileMenuOpen = false"
                        class="flex items-center text-white hover:text-gray-200 py-3 px-2 rounded-lg hover:bg-white hover:bg-opacity-10 transition-colors duration-200 bangla-text">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        হোম
                    </a>

                    <a href="{{ route('poets.index') }}" @click="mobileMenuOpen = false"
                        class="flex items-center text-white hover:text-gray-200 py-3 px-2 rounded-lg hover:bg-white hover:bg-opacity-10 transition-colors duration-200 bangla-text">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        খ্যাতিমান লেখক
                    </a>

                    <a href="{{ route('posts.index') }}" @click="mobileMenuOpen = false"
                        class="flex items-center text-white hover:text-gray-200 py-3 px-2 rounded-lg hover:bg-white hover:bg-opacity-10 transition-colors duration-200 bangla-text">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        কবিতার আসর
                    </a>

                    @auth
                        <a href="{{ route('adda.index') }}" @click="mobileMenuOpen = false"
                            class="flex items-center text-white hover:text-gray-200 py-3 px-2 rounded-lg hover:bg-white hover:bg-opacity-10 transition-colors duration-200 bangla-text">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                            </svg>
                            আড্ডা
                        </a>
                    @endauth


                    <a href="#" @click="mobileMenuOpen = false"
                        class="flex items-center text-white hover:text-gray-200 py-3 px-2 rounded-lg hover:bg-white hover:bg-opacity-10 transition-colors duration-200 bangla-text">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        আলোচনা
                    </a>
                </div>

                <!-- User Actions (if authenticated) -->
                @auth
                    <div class="border-t border-white border-opacity-20 px-4 py-4">
                        <div class="space-y-3">
                            <a href="{{ route('dashboard') }}" @click="mobileMenuOpen = false"
                                class="flex items-center text-teal-200 hover:text-teal-100 py-2 bangla-text">
                                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                আপনার পাতা
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex items-center text-red-300 hover:text-red-200 py-2 bangla-text w-full text-left">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    লগ আউট
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="border-t border-white border-opacity-20 px-4 py-4">
                        <div class="space-y-3">
                            <a href="{{ route('register') }}" @click="mobileMenuOpen = false"
                                class="flex items-center text-teal-200 hover:text-teal-100 py-2 bangla-text">
                                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                রেজিস্ট্রেশন
                            </a>

                            <a href="{{ route('login') }}" @click="mobileMenuOpen = false"
                                class="flex items-center text-teal-200 hover:text-teal-100 py-2 bangla-text">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                                লগ ইন
                            </a>
                        </div>
                    </div>
                @endauth
            </div>
        </nav>

        <!-- Page Content -->
        <main class="py-6" x-data="{ sidebarOpen: false }">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Mobile Sidebar Toggle Button -->
                <div class="lg:hidden mb-4">
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="flex items-center justify-center w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <span class="bangla-text">সাইডবার দেখুন</span>
                    </button>
                </div>

                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Main Content Area -->
                    <div class="flex-1 min-w-0">
                        @yield('content')
                    </div>

                    <!-- Sidebar -->
                    <div class="lg:w-80 flex-shrink-0" :class="sidebarOpen ? 'block' : 'hidden lg:block'"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95">
                        @yield('sidebar')
                    </div>
                </div>
            </div>
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
                            <li><a href="{{ route('posts.index') }}"
                                    class="text-gray-300 hover:text-white bangla-text">কবিতা</a></li>
                            <li><a href="{{ route('poets.index') }}"
                                    class="text-gray-300 hover:text-white bangla-text">লেখক</a></li>
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
