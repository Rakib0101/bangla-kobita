@extends('layouts.bangla-app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 bangla-text">
                    কবিতা ব্যবস্থাপনা
                </h1>
                <p class="text-gray-600 bangla-text mt-2">
                    সব কবিতার তালিকা ও ব্যবস্থাপনা
                </p>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('admin.dashboard') }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded bangla-text">
                    ড্যাশবোর্ডে ফিরুন
                </a>
            </div>
        </div>
    </div>

    <!-- Filter Options -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('admin.poems', ['status' => 'all']) }}" 
               class="px-4 py-2 rounded {{ request('status') === 'all' || !request('status') ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }} bangla-text">
                সব কবিতা
            </a>
            <a href="{{ route('admin.poems', ['status' => 'published']) }}" 
               class="px-4 py-2 rounded {{ request('status') === 'published' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-700' }} bangla-text">
                প্রকাশিত
            </a>
            <a href="{{ route('admin.poems', ['status' => 'draft') }}" 
               class="px-4 py-2 rounded {{ request('status') === 'draft' ? 'bg-yellow-600 text-white' : 'bg-gray-200 text-gray-700' }} bangla-text">
                খসড়া
            </a>
        </div>
    </div>

    <!-- Poems Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900 bangla-text">
                কবিতার তালিকা ({{ $poems->total() }} টি)
            </h2>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bangla-text">
                            কবিতা
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bangla-text">
                            লেখক
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bangla-text">
                            বিভাগ
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bangla-text">
                            স্ট্যাটাস
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bangla-text">
                            প্রকাশের তারিখ
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider bangla-text">
                            ক্রিয়া
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($poems as $poem)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex-1 min-w-0">
                                    <div class="text-sm font-medium text-gray-900 bangla-text">
                                        {{ $poem->title_bangla ?? $poem->title }}
                                    </div>
                                    @if($poem->title_bangla && $poem->title !== $poem->title_bangla)
                                        <div class="text-sm text-gray-500">
                                            {{ $poem->title }}
                                        </div>
                                    @endif
                                    <div class="text-xs text-gray-500 mt-1">
                                        {{ Str::limit(strip_tags($poem->content_bangla ?? $poem->content), 100) }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 bangla-text">
                                    {{ $poem->user->name_bangla ?? $poem->user->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 bangla-text">
                                    {{ $poem->category->name_bangla ?? $poem->category->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $poem->is_published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }} bangla-text">
                                    {{ $poem->is_published ? 'প্রকাশিত' : 'খসড়া' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $poem->published_at ? $poem->published_at->format('d M Y') : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('poems.show', $poem) }}" 
                                       class="text-indigo-600 hover:text-indigo-900 bangla-text">
                                        দেখুন
                                    </a>
                                    <a href="{{ route('poems.edit', $poem) }}" 
                                       class="text-yellow-600 hover:text-yellow-900 bangla-text">
                                        সম্পাদনা
                                    </a>
                                    <form action="{{ route('poems.destroy', $poem) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-900 bangla-text"
                                                onclick="return confirm('আপনি কি নিশ্চিত যে আপনি এই কবিতাটি মুছে ফেলতে চান?')">
                                            মুছুন
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $poems->links() }}
        </div>
    </div>
</div>
@endsection
