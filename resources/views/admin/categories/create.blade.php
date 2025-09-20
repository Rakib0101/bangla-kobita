@extends('layouts.admin')

@section('title', 'Create Category')
@section('page-title', 'নতুন বিভাগ তৈরি করুন')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow rounded-lg p-6">
        <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name_bangla" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                        বিভাগের নাম (বাংলা) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="name_bangla" name="name_bangla" value="{{ old('name_bangla') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bangla-text"
                           required>
                    @error('name_bangla')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="name_english" class="block text-sm font-medium text-gray-700 mb-2">
                        বিভাগের নাম (English)
                    </label>
                    <input type="text" id="name_english" name="name_english" value="{{ old('name_english') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('name_english')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="description_bangla" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                        বর্ণনা (বাংলা)
                    </label>
                    <textarea id="description_bangla" name="description_bangla" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bangla-text">{{ old('description_bangla') }}</textarea>
                    @error('description_bangla')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="description_english" class="block text-sm font-medium text-gray-700 mb-2">
                        বর্ণনা (English)
                    </label>
                    <textarea id="description_english" name="description_english" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description_english') }}</textarea>
                    @error('description_english')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="color" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                        রঙ
                    </label>
                    <input type="color" id="color" name="color" value="{{ old('color', '#3B82F6') }}"
                           class="w-full h-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('color')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                        ক্রম
                    </label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           min="0">
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex items-center">
                    <div class="flex items-center">
                        <input type="checkbox" id="is_active" name="is_active" value="1" 
                               {{ old('is_active', true) ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_active" class="ml-2 block text-sm text-gray-900 bangla-text">
                            সক্রিয়
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.categories') }}" 
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded bangla-text">
                    বাতিল
                </a>
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded bangla-text">
                    বিভাগ তৈরি করুন
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
