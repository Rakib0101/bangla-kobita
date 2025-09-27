@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'ড্যাশবোর্ড')

@section('content')
    <div class="space-y-6">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Users -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                                <i class="fas fa-users text-white"></i>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate bangla-text">মোট ইউজার</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ number_format($totalUsers) }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-5 py-3">
                    <div class="text-sm">
                        <span class="text-green-600 font-medium">+{{ $activeUsers }}</span>
                        <span class="text-gray-500 bangla-text">সক্রিয়</span>
                    </div>
                </div>
            </div>

            <!-- Total Poems -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                                <i class="fas fa-book-open text-white"></i>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate bangla-text">মোট কবিতা</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ number_format($totalPoems) }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-5 py-3">
                    <div class="text-sm">
                        <span class="text-green-600 font-medium">{{ $publishedPoems }}</span>
                        <span class="text-gray-500 bangla-text">প্রকাশিত</span>
                    </div>
                </div>
            </div>

            <!-- Categories -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                                <i class="fas fa-tags text-white"></i>
                            </div>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate bangla-text">বিভাগ</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ number_format($totalCategories) }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-5 py-3">
                    <div class="text-sm">
                        <span class="text-blue-600 font-medium">{{ $totalPoets }}</span>
                        <span class="text-gray-500 bangla-text">কবি</span>
                    </div>
                </div>
            </div>

            <!-- Pending Approval -->
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
                                <dt class="text-sm font-medium text-gray-500 truncate bangla-text">অনুমোদনের অপেক্ষায়</dt>
                                <dd class="text-lg font-medium text-gray-900">{{ $pendingPoems->count() }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-5 py-3">
                    <div class="text-sm">
                        <a href="{{ route('admin.posts', ['status' => 'draft']) }}"
                            class="text-blue-600 hover:text-blue-800 bangla-text">দেখুন →</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts and Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Activity Chart -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4 bangla-text">সপ্তাহিক কার্যকলাপ</h3>
                <div style="position: relative; height: 200px; width: 100%;">
                    <canvas id="activityChart"></canvas>
                </div>
            </div>

            <!-- Recent Users -->
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 bangla-text">সদ্য যোগদানকারী</h3>
                    <a href="{{ route('admin.users') }}" class="text-sm text-blue-600 hover:text-blue-800 bangla-text">সব
                        দেখুন</a>
                </div>
                <div class="space-y-3">
                    @forelse($recentUsers as $user)
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                <span class="text-sm font-medium text-gray-700">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 bangla-text">
                                    {{ $user->name_bangla ?? $user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $user->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="flex-shrink-0">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $user->is_active ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4 bangla-text">কোন নতুন ইউজার নেই</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Poems and Pending Approval -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Poems -->
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 bangla-text">সদ্য প্রকাশিত কবিতা</h3>
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
                                    {{ Str::limit($poem->title_bangla, 50) }}</p>
                                <p class="text-sm text-gray-500 bangla-text">লেখক:
                                    {{ $poem->user->name_bangla ?? $poem->user->name }}</p>
                                <p class="text-xs text-gray-400">{{ $poem->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="flex-shrink-0">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $poem->is_published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $poem->is_published ? 'প্রকাশিত' : 'খসড়া' }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4 bangla-text">কোন কবিতা নেই</p>
                    @endforelse
                </div>
            </div>

            <!-- Pending Approval -->
            <div class="bg-white shadow rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 bangla-text">অনুমোদনের অপেক্ষায়</h3>
                    <a href="{{ route('admin.posts', ['status' => 'draft']) }}"
                        class="text-sm text-blue-600 hover:text-blue-800 bangla-text">সব দেখুন</a>
                </div>
                <div class="space-y-3">
                    @forelse($pendingPoems as $poem)
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-clock text-yellow-600 text-sm"></i>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 bangla-text">
                                    {{ Str::limit($poem->title_bangla, 50) }}</p>
                                <p class="text-sm text-gray-500 bangla-text">লেখক:
                                    {{ $poem->user->name_bangla ?? $poem->user->name }}</p>
                                <p class="text-xs text-gray-400">{{ $poem->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="flex space-x-1">
                                    <button class="text-green-600 hover:text-green-800" title="অনুমোদন করুন">
                                        <i class="fas fa-check text-sm"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800" title="প্রত্যাখ্যান করুন">
                                        <i class="fas fa-times text-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4 bangla-text">অনুমোদনের অপেক্ষায় কোন কবিতা নেই</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4 bangla-text">দ্রুত কাজ</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('posts.create') }}"
                    class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-plus text-blue-600"></i>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900 bangla-text">নতুন কবিতা</h4>
                        <p class="text-sm text-gray-500 bangla-text">কবিতা লিখুন</p>
                    </div>
                </a>

                <a href="{{ route('admin.categories') }}"
                    class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-tags text-green-600"></i>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900 bangla-text">বিভাগ ম্যানেজ</h4>
                        <p class="text-sm text-gray-500 bangla-text">বিভাগ যোগ/সম্পাদনা</p>
                    </div>
                </a>

                <a href="{{ route('admin.settings') }}"
                    class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-cog text-purple-600"></i>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-900 bangla-text">সেটিংস</h4>
                        <p class="text-sm text-gray-500 bangla-text">ওয়েবসাইট সেটিংস</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    @section('scripts')
        <script>
            // Activity Chart
            const ctx = document.getElementById('activityChart').getContext('2d');
            const activityChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['সোম', 'মঙ্গল', 'বুধ', 'বৃহস্পতি', 'শুক্র', 'শনি', 'রবি'],
                    datasets: [{
                        label: 'কবিতা',
                        data: [12, 19, 3, 5, 2, 3, 8],
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4
                    }, {
                        label: 'ইউজার',
                        data: [2, 3, 20, 5, 1, 4, 6],
                        borderColor: 'rgb(16, 185, 129)',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        tension: 0.4
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
