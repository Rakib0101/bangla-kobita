@extends('layouts.admin')

@section('title', 'Writers Management')
@section('page-title', 'লেখক ম্যানেজমেন্ট')

@section('content')
    <div class="space-y-6">
        <!-- Header Actions -->
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 bangla-text">লেখক তালিকা</h2>
                <p class="text-gray-600 bangla-text">সব লেখকের তালিকা এবং তাদের রচনা</p>
            </div>
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded bangla-text">
                <i class="fas fa-plus mr-2"></i>নতুন লেখক যোগ করুন
            </button>
        </div>

        <!-- Search and Filter -->
        <div class="bg-white shadow rounded-lg p-6">
            <form method="GET" action="{{ route('admin.poets') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                            খুঁজুন
                        </label>
                        <input type="text" id="search" name="search" value="{{ request('search') }}"
                            placeholder="লেখকের নাম খুঁজুন"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bangla-text">
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                            অবস্থা
                        </label>
                        <select id="status" name="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">সব অবস্থা</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>সক্রিয়</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>নিষ্ক্রিয়
                            </option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded bangla-text">
                            খুঁজুন
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Poets Table -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bangla-text">
                                লেখক
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bangla-text">
                                রচনার সংখ্যা
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bangla-text">
                                যোগদানের তারিখ
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bangla-text">
                                অবস্থা
                            </th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bangla-text">
                                কাজ
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($poets as $poet)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                                            <span
                                                class="text-sm font-medium text-gray-700">{{ substr($poet->name, 0, 1) }}</span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 bangla-text">
                                                {{ $poet->name_bangla ?? $poet->name }}
                                            </div>
                                            @if ($poet->name_english && $poet->name_english !== $poet->name)
                                                <div class="text-sm text-gray-500">{{ $poet->name_english }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $poet->poems_count }} রচনা
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $poet->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $poet->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $poet->is_active ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="#" class="text-blue-600 hover:text-blue-900 bangla-text">দেখুন</a>
                                        <a href="#"
                                            class="text-indigo-600 hover:text-indigo-900 bangla-text">সম্পাদনা</a>
                                        <button class="text-red-600 hover:text-red-900 bangla-text">মুছুন</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="text-gray-500 bangla-text">
                                        <i class="fas fa-user-tie text-4xl mb-4"></i>
                                        <p class="text-lg font-medium">কোন লেখক পাওয়া যায়নি</p>
                                        <p class="text-sm">এখনো কোন লেখক নিবন্ধিত হয়নি।</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($poets->hasPages())
                <div class="px-6 py-3 border-t border-gray-200">
                    {{ $poets->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
