@extends('layouts.bangla-app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 bangla-text">
                    বিভাগ ব্যবস্থাপনা
                </h1>
                <p class="text-gray-600 bangla-text mt-2">
                    সব বিভাগের তালিকা ও ব্যবস্থাপনা
                </p>
            </div>
            <div class="flex space-x-4">
                <a href="{{ route('admin.dashboard') }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded bangla-text">
                    ড্যাশবোর্ডে ফিরুন
                </a>
                <a href="{{ route('admin.categories.create') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded bangla-text">
                    নতুন বিভাগ
                </a>
            </div>
        </div>
    </div>

    <!-- Categories Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($categories as $category)
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 bangla-text">
                        {{ $category->name_bangla ?? $category->name }}
                    </h3>
                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                        {{ $category->poems_count }} কবিতা
                    </span>
                </div>
                
                @if($category->name_bangla && $category->name !== $category->name_bangla)
                    <p class="text-sm text-gray-600 mb-4">
                        {{ $category->name }}
                    </p>
                @endif
                
                @if($category->description_bangla || $category->description)
                    <p class="text-sm text-gray-700 mb-4 bangla-text">
                        {{ $category->description_bangla ?? $category->description }}
                    </p>
                @endif
                
                <div class="flex items-center justify-between">
                    <div class="text-xs text-gray-500">
                        {{ $category->created_at->format('d M Y') }}
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.categories.edit', $category) }}" 
                           class="text-yellow-600 hover:text-yellow-900 text-sm bangla-text">
                            সম্পাদনা
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-600 hover:text-red-900 text-sm bangla-text"
                                    onclick="return confirm('আপনি কি নিশ্চিত যে আপনি এই বিভাগটি মুছে ফেলতে চান?')">
                                মুছুন
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    <div class="mt-6">
        {{ $categories->links() }}
    </div>
</div>
@endsection
