<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') - {{ config('app.name', 'বাংলা কবিতা') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .bangla-text {
            font-family: 'Noto Sans Bengali', sans-serif;
        }

        .sidebar-transition {
            transition: all 0.3s ease-in-out;
        }

        .content-transition {
            transition: margin-left 0.3s ease-in-out;
        }

        .sidebar-active {
            background-color: #3b82f6;
            color: white;
        }

        .sidebar-hover:hover {
            background-color: #f3f4f6;
        }

        .sidebar-active .sidebar-hover:hover {
            background-color: #2563eb;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div id="sidebar"
            class="w-64 bg-white shadow-lg sidebar-transition fixed inset-y-0 left-0 z-50 lg:static lg:translate-x-0 transform -translate-x-full">
            <div class="flex items-center justify-between h-16 px-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-crown text-white text-sm"></i>
                    </div>
                    <span class="ml-3 text-xl font-bold text-gray-900 bangla-text">এডমিন</span>
                </div>
                <button id="sidebar-toggle" class="lg:hidden">
                    <i class="fas fa-times text-gray-500"></i>
                </button>
            </div>

            <nav class="mt-6 px-3">
                <div class="space-y-1">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard.admin') }}"
                        class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('dashboard.admin') ? 'sidebar-active' : 'text-gray-700 sidebar-hover' }}">
                        <i class="fas fa-tachometer-alt mr-3 text-sm"></i>
                        ড্যাশবোর্ড
                    </a>

                    <!-- Content Management -->
                    <div class="pt-4">
                        <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider bangla-text">
                            কন্টেন্ট ম্যানেজমেন্ট</h3>
                        <div class="mt-2 space-y-1">
                            <a href="{{ route('admin.posts') }}"
                                class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.posts*') ? 'sidebar-active' : 'text-gray-700 sidebar-hover' }}">
                                <i class="fas fa-book-open mr-3 text-sm"></i>
                                কবিতা
                            </a>
                            <a href="{{ route('admin.categories') }}"
                                class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.categories*') ? 'sidebar-active' : 'text-gray-700 sidebar-hover' }}">
                                <i class="fas fa-tags mr-3 text-sm"></i>
                                বিভাগ
                            </a>
                            <a href="{{ route('admin.poets') }}"
                                class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.poets*') ? 'sidebar-active' : 'text-gray-700 sidebar-hover' }}">
                                <i class="fas fa-user-tie mr-3 text-sm"></i>
                                লেখক
                            </a>
                        </div>
                    </div>

                    <!-- User Management -->
                    <div class="pt-4">
                        <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider bangla-text">ইউজার
                            ম্যানেজমেন্ট</h3>
                        <div class="mt-2 space-y-1">
                            <a href="{{ route('admin.users') }}"
                                class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.users*') ? 'sidebar-active' : 'text-gray-700 sidebar-hover' }}">
                                <i class="fas fa-users mr-3 text-sm"></i>
                                ইউজার
                            </a>
                        </div>
                    </div>

                    <!-- Settings -->
                    <div class="pt-4">
                        <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider bangla-text">সেটিংস
                        </h3>
                        <div class="mt-2 space-y-1">
                            <a href="{{ route('admin.settings') }}"
                                class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.settings*') ? 'sidebar-active' : 'text-gray-700 sidebar-hover' }}">
                                <i class="fas fa-cog mr-3 text-sm"></i>
                                ওয়েবসাইট সেটিংস
                            </a>
                            <a href="{{ route('admin.analytics') }}"
                                class="group flex items-center px-3 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.analytics*') ? 'sidebar-active' : 'text-gray-700 sidebar-hover' }}">
                                <i class="fas fa-chart-line mr-3 text-sm"></i>
                                অ্যানালিটিক্স
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col content-transition lg:ml-0" id="main-content">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center">
                        <button id="mobile-sidebar-toggle"
                            class="lg:hidden p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
                            <i class="fas fa-bars text-lg"></i>
                        </button>
                        <h1 class="ml-4 text-2xl font-semibold text-gray-900 bangla-text">@yield('page-title', 'ড্যাশবোর্ড')</h1>
                    </div>

                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <button class="p-2 text-gray-400 hover:text-gray-500 relative">
                            <i class="fas fa-bell text-lg"></i>
                            <span
                                class="absolute -top-1 -right-1 h-4 w-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">3</span>
                        </button>

                        <!-- User Menu -->
                        <div class="relative">
                            <button id="user-menu-button"
                                class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                                    <span
                                        class="text-white font-medium text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                </div>
                                <span
                                    class="ml-2 text-gray-700 bangla-text">{{ auth()->user()->name_bangla ?? auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down ml-1 text-gray-400"></i>
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="user-menu"
                                class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 bangla-text">
                                    <i class="fas fa-user mr-2"></i>প্রোফাইল
                                </a>
                                <a href="{{ route('dashboard.user') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 bangla-text">
                                    <i class="fas fa-home mr-2"></i>ইউজার ড্যাশবোর্ড
                                </a>
                                <a href="{{ route('posts.index') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 bangla-text">
                                    <i class="fas fa-book mr-2"></i>সাইট দেখুন
                                </a>
                                <div class="border-t border-gray-100"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 bangla-text">
                                        <i class="fas fa-sign-out-alt mr-2"></i>লগআউট
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6">
                @if (session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                        role="alert">
                        <span class="block sm:inline bangla-text">{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert">
                        <span class="block sm:inline bangla-text">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Overlay for mobile -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-gray-600 bg-opacity-75 z-40 hidden lg:hidden"></div>

    <script>
        // Sidebar toggle functionality
        const sidebarToggle = document.getElementById('mobile-sidebar-toggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const mainContent = document.getElementById('main-content');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });

        // User menu toggle
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = document.getElementById('user-menu');

        userMenuButton.addEventListener('click', () => {
            userMenu.classList.toggle('hidden');
        });

        // Close user menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!userMenuButton.contains(e.target) && !userMenu.contains(e.target)) {
                userMenu.classList.add('hidden');
            }
        });
    </script>

    @yield('scripts')
</body>

</html>
