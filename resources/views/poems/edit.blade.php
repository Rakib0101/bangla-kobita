@extends('layouts.bangla-app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-md p-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 bangla-text">কবিতা সম্পাদনা</h1>
                <p class="text-gray-600 bangla-text mt-2">আপনার কবিতাটি সম্পাদনা করুন</p>
            </div>

            <form method="POST" action="{{ route('poems.update', $poem) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Title Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title_bangla" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                            কবিতার শিরোনাম (বাংলা) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="title_bangla" name="title_bangla"
                            value="{{ old('title_bangla', $poem->title_bangla) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bangla-text"
                            required>
                        @error('title_bangla')
                            <p class="mt-1 text-sm text-red-600 bangla-text">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="title_english" class="block text-sm font-medium text-gray-700 mb-2">
                            কবিতার শিরোনাম (ইংরেজি)
                        </label>
                        <input type="text" id="title_english" name="title_english"
                            value="{{ old('title_english', $poem->title_english) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('title_english')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Content Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="content_bangla" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                            কবিতার বিষয়বস্তু (বাংলা) <span class="text-red-500">*</span>
                        </label>
                        <textarea id="content_bangla" name="content_bangla" rows="12"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bangla-text"
                            required>{{ old('content_bangla', $poem->content_bangla) }}</textarea>
                        @error('content_bangla')
                            <p class="mt-1 text-sm text-red-600 bangla-text">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="content_english" class="block text-sm font-medium text-gray-700 mb-2">
                            কবিতার বিষয়বস্তু (ইংরেজি)
                        </label>
                        <textarea id="content_english" name="content_english" rows="12"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('content_english', $poem->content_english) }}</textarea>
                        @error('content_english')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Category and Tags -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                            বিভাগ <span class="text-red-500">*</span>
                        </label>
                        <select id="category_id" name="category_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                            <option value="">বিভাগ নির্বাচন করুন</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $poem->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name_bangla }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600 bangla-text">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tags" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                            ট্যাগ (কমা দিয়ে আলাদা করুন)
                        </label>
                        <input type="text" id="tags" name="tags"
                            value="{{ old('tags', $poem->tags->pluck('name')->join(', ')) }}"
                            placeholder="প্রেম, প্রকৃতি, জীবন"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bangla-text">
                        @error('tags')
                            <p class="mt-1 text-sm text-red-600 bangla-text">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Publication Status -->
                <div class="flex items-center">
                    <input type="checkbox" id="is_published" name="is_published" value="1"
                        {{ old('is_published', $poem->is_published) ? 'checked' : '' }}
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_published" class="ml-2 block text-sm text-gray-700 bangla-text">
                        কবিতাটি প্রকাশিত করুন
                    </label>
                </div>

                <!-- Keyboard Switcher for Bengali Input -->
                <x-keyboard-switcher name="input_method" value="{{ old('input_method', 'avro') }}" />

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('poems.show', $poem) }}"
                        class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded bangla-text">
                        বাতিল
                    </a>
                    <div class="flex space-x-4">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded bangla-text">
                            আপডেট করুন
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
