@extends('layouts.admin')

@section('title', 'Analytics')
@section('page-title', 'অ্যানালিটিক্স')

@section('content')
    <div class="space-y-6">
        <!-- Analytics Overview Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                                <i class="fas fa-eye text-white"></i>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate bangla-text">মোট ভিউ</dt>
                                <dd class="text-lg font-medium text-gray-900">12,345</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                                <i class="fas fa-users text-white"></i>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate bangla-text">সক্রিয় ইউজার</dt>
                                <dd class="text-lg font-medium text-gray-900">1,234</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                                <i class="fas fa-book-open text-white"></i>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate bangla-text">পড়া কবিতা</dt>
                                <dd class="text-lg font-medium text-gray-900">5,678</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                                <i class="fas fa-clock text-white"></i>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate bangla-text">গড় সময়</dt>
                                <dd class="text-lg font-medium text-gray-900">3:45</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Monthly Poems Chart -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4 bangla-text">মাসিক কবিতা</h3>
                <canvas id="poemsChart" width="400" height="200"></canvas>
            </div>

            <!-- Monthly Users Chart -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4 bangla-text">মাসিক ইউজার</h3>
                <canvas id="usersChart" width="400" height="200"></canvas>
            </div>
        </div>

        <!-- Popular Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Most Popular Poems -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4 bangla-text">জনপ্রিয় কবিতা</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-blue-600 font-medium text-sm">1</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 bangla-text">প্রেমের কবিতা</p>
                                <p class="text-xs text-gray-500 bangla-text">রবীন্দ্রনাথ ঠাকুর</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">1,234</p>
                            <p class="text-xs text-gray-500 bangla-text">ভিউ</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                <span class="text-green-600 font-medium text-sm">2</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 bangla-text">প্রকৃতির কবিতা</p>
                                <p class="text-xs text-gray-500 bangla-text">কাজী নজরুল ইসলাম</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">987</p>
                            <p class="text-xs text-gray-500 bangla-text">ভিউ</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                <span class="text-yellow-600 font-medium text-sm">3</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 bangla-text">দেশপ্রেমের কবিতা</p>
                                <p class="text-xs text-gray-500 bangla-text">সুকান্ত ভট্টাচার্য</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">756</p>
                            <p class="text-xs text-gray-500 bangla-text">ভিউ</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Categories -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4 bangla-text">জনপ্রিয় বিভাগ</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-heart text-blue-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 bangla-text">প্রেমের কবিতা</p>
                                <p class="text-xs text-gray-500">২৩৪টি কবিতা</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">45%</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-leaf text-green-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 bangla-text">প্রকৃতির কবিতা</p>
                                <p class="text-xs text-gray-500">১৮৯টি কবিতা</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">32%</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-flag text-red-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 bangla-text">দেশপ্রেমের কবিতা</p>
                                <p class="text-xs text-gray-500">১৫৬টি কবিতা</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">23%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Traffic Sources -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4 bangla-text">ট্র্যাফিক সোর্স</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-search text-blue-600 text-xl"></i>
                    </div>
                    <h4 class="text-lg font-medium text-gray-900 bangla-text">সার্চ ইঞ্জিন</h4>
                    <p class="text-3xl font-bold text-blue-600">65%</p>
                    <p class="text-sm text-gray-500 bangla-text">৮,০২৩ ভিজিট</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-share text-green-600 text-xl"></i>
                    </div>
                    <h4 class="text-lg font-medium text-gray-900 bangla-text">সোশ্যাল মিডিয়া</h4>
                    <p class="text-3xl font-bold text-green-600">25%</p>
                    <p class="text-sm text-gray-500 bangla-text">৩,০৮৫ ভিজিট</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-link text-purple-600 text-xl"></i>
                    </div>
                    <h4 class="text-lg font-medium text-gray-900 bangla-text">ডাইরেক্ট</h4>
                    <p class="text-3xl font-bold text-purple-600">10%</p>
                    <p class="text-sm text-gray-500 bangla-text">১,২৩৪ ভিজিট</p>
                </div>
            </div>
        </div>
    </div>

@section('scripts')
    <script>
        // Poems Chart
        const poemsCtx = document.getElementById('poemsChart').getContext('2d');
        const poemsChart = new Chart(poemsCtx, {
            type: 'line',
            data: {
                labels: ['জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর',
                    'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'
                ],
                datasets: [{
                    label: 'কবিতা',
                    data: [12, 19, 3, 5, 2, 3, 8, 15, 12, 18, 22, 25],
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Users Chart
        const usersCtx = document.getElementById('usersChart').getContext('2d');
        const usersChart = new Chart(usersCtx, {
            type: 'bar',
            data: {
                labels: ['জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর',
                    'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'
                ],
                datasets: [{
                    label: 'নতুন ইউজার',
                    data: [5, 8, 12, 15, 18, 22, 25, 28, 20, 16, 19, 23],
                    backgroundColor: 'rgba(16, 185, 129, 0.8)',
                    borderColor: 'rgb(16, 185, 129)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
@endsection
