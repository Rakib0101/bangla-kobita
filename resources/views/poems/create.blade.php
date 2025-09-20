@extends('layouts.bangla-app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md p-8">
            <h1 class="text-3xl font-bold mb-6 bangla-text">নতুন কবিতা লিখুন</h1>

            <form method="POST" action="{{ route('poems.store') }}" class="space-y-6">
                @csrf

                <!-- Poem Title in Bangla -->
                <div>
                    <label for="title_bangla" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                        কবিতার শিরোনাম (বাংলায়)
                    </label>
                    <x-keyboard-switcher name="input_method" value="{{ old('input_method', 'avro') }}" />
                    <input type="text" id="title_bangla" name="title_bangla" value="{{ old('title_bangla') }}"
                        class="mt-2 block w-full bangla-input border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="কবিতার শিরোনাম লিখুন..." required>
                    @error('title_bangla')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Poem Title in English -->
                <div>
                    <label for="title_english" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                        কবিতার শিরোনাম (ইংরেজিতে)
                    </label>
                    <input type="text" id="title_english" name="title_english" value="{{ old('title_english') }}"
                        class="block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Poem title in English...">
                    @error('title_english')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category Selection -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                        কবিতার বিভাগ
                    </label>
                    <select id="category_id" name="category_id"
                        class="block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        required>
                        <option value="">বিভাগ নির্বাচন করুন</option>
                        @foreach (\App\Models\Category::where('is_active', true)->orderBy('sort_order')->get() as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name_bangla }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Poet Selection (if translation) -->
                <div>
                    <label for="poet_id" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                        মূল কবি (যদি অনুবাদ হয়)
                    </label>
                    <select id="poet_id" name="poet_id"
                        class="block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">মূল কবি নির্বাচন করুন</option>
                        @foreach (\App\Models\Poet::where('is_active', true)->orderBy('sort_order')->get() as $poet)
                            <option value="{{ $poet->id }}" {{ old('poet_id') == $poet->id ? 'selected' : '' }}>
                                {{ $poet->name_bangla }}
                            </option>
                        @endforeach
                    </select>
                    @error('poet_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Poem Content in Bangla -->
                <div>
                    <label for="content_bangla" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                        কবিতার বিষয়বস্তু (বাংলায়)
                    </label>
                    <textarea id="content_bangla" name="content_bangla" rows="15"
                        class="block w-full bangla-input border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="আপনার কবিতা এখানে লিখুন..." required>{{ old('content_bangla') }}</textarea>
                    @error('content_bangla')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Poem Content in English (if translation) -->
                <div>
                    <label for="content_english" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                        কবিতার বিষয়বস্তু (ইংরেজিতে)
                    </label>
                    <textarea id="content_english" name="content_english" rows="15"
                        class="block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="English translation of the poem...">{{ old('content_english') }}</textarea>
                    @error('content_english')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tags -->
                <div>
                    <label for="tags" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                        ট্যাগ (কমা দিয়ে আলাদা করুন)
                    </label>
                    <input type="text" id="tags" name="tags" value="{{ old('tags') }}"
                        class="block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="প্রেম, প্রকৃতি, জীবন...">
                    @error('tags')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Poem Type Options -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="flex items-center">
                        <input type="checkbox" id="is_translation" name="is_translation" value="1"
                            {{ old('is_translation') ? 'checked' : '' }}
                            class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out">
                        <label for="is_translation" class="ml-2 text-sm text-gray-700 bangla-text">
                            এটি একটি অনুবাদ
                        </label>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="is_featured" name="is_featured" value="1"
                            {{ old('is_featured') ? 'checked' : '' }}
                            class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out">
                        <label for="is_featured" class="ml-2 text-sm text-gray-700 bangla-text">
                            বিশেষ কবিতা
                        </label>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" id="is_published" name="is_published" value="1"
                            {{ old('is_published') ? 'checked' : '' }}
                            class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out">
                        <label for="is_published" class="ml-2 text-sm text-gray-700 bangla-text">
                            এখনই প্রকাশ করুন
                        </label>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('poems.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded bangla-text">
                        বাতিল
                    </a>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded bangla-text">
                        কবিতা সংরক্ষণ করুন
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
