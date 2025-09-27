@extends('layouts.bangla-app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-md p-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 bangla-text">কবিতা সম্পাদনা</h1>
                <p class="text-gray-600 bangla-text mt-2">আপনার কবিতাটি সম্পাদনা করুন</p>
            </div>

            <form method="POST" action="{{ route('posts.update', $poem) }}" enctype="multipart/form-data" class="space-y-6">
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

                <!-- Media Options -->
                <div class="border-t pt-6">
                    <h3 class="text-lg font-semibold mb-4 bangla-text">মিডিয়া অপশন</h3>

                    <!-- Current Image Display -->
                    @if ($poem->image_path)
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                                বর্তমান ছবি
                            </label>
                            <div class="flex items-center space-x-4">
                                <img src="{{ Storage::url($poem->image_path) }}" alt="Current image"
                                    class="max-w-xs h-auto rounded-lg shadow-md">
                                <div>
                                    <p class="text-sm text-gray-600 bangla-text">নতুন ছবি আপলোড করলে পুরাতন ছবি প্রতিস্থাপিত
                                        হবে</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Image Upload -->
                    <div class="mb-6">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                            {{ $poem->image_path ? 'নতুন ছবি আপলোড করুন' : 'কবিতার ছবি আপলোড করুন' }}
                        </label>
                        <input type="file" id="image" name="image" accept="image/*"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                            onchange="previewImage(this)">
                        @error('image')
                            <p class="mt-1 text-sm text-red-600 bangla-text">{{ $message }}</p>
                        @enderror

                        <!-- Image Preview -->
                        <div id="imagePreview" class="mt-3 hidden">
                            <img id="previewImg" src="" alt="Preview" class="max-w-xs h-auto rounded-lg shadow-md">
                            <button type="button" onclick="removeImage()"
                                class="mt-2 text-sm text-red-600 hover:text-red-800 bangla-text">
                                ছবি সরান
                            </button>
                        </div>
                    </div>

                    <!-- YouTube Embed Code -->
                    <div class="mb-6">
                        <label for="youtube_embed_code" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                            YouTube এম্বেড কোড (ঐচ্ছিক)
                        </label>
                        <textarea id="youtube_embed_code" name="youtube_embed_code" rows="4"
                            class="block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="YouTube ভিডিওর এম্বেড কোড এখানে পেস্ট করুন...">{{ old('youtube_embed_code', $poem->youtube_embed_code) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500 bangla-text">
                            YouTube ভিডিওর "Share" বাটনে ক্লিক করে "Embed" অপশন থেকে কোড কপি করুন
                        </p>
                        @error('youtube_embed_code')
                            <p class="mt-1 text-sm text-red-600 bangla-text">{{ $message }}</p>
                        @enderror

                        <!-- Current YouTube Video -->
                        @if ($poem->youtube_embed_code)
                            <div class="mt-3">
                                <label class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                                    বর্তমান ভিডিও
                                </label>
                                <div id="currentYoutube" class="w-full max-w-md">
                                    {!! $poem->youtube_embed_code !!}
                                </div>
                            </div>
                        @endif

                        <!-- YouTube Preview -->
                        <div id="youtubePreview" class="mt-3 hidden">
                            <div id="previewYoutube" class="w-full max-w-md"></div>
                            <button type="button" onclick="removeYoutube()"
                                class="mt-2 text-sm text-red-600 hover:text-red-800 bangla-text">
                                ভিডিও সরান
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Keyboard Switcher for Bengali Input -->
                <x-keyboard-switcher name="input_method" value="{{ old('input_method', 'avro') }}" />

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('posts.show', $poem) }}"
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

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImg').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeImage() {
            document.getElementById('image').value = '';
            document.getElementById('imagePreview').classList.add('hidden');
            document.getElementById('previewImg').src = '';
        }

        function previewYoutube() {
            const embedCode = document.getElementById('youtube_embed_code').value.trim();
            if (embedCode) {
                // Extract video ID from embed code
                const videoIdMatch = embedCode.match(/embed\/([a-zA-Z0-9_-]+)/);
                if (videoIdMatch) {
                    const videoId = videoIdMatch[1];
                    const previewDiv = document.getElementById('previewYoutube');
                    previewDiv.innerHTML = `
                        <iframe width="100%" height="200" 
                                src="https://www.youtube.com/embed/${videoId}" 
                                frameborder="0" 
                                allowfullscreen>
                        </iframe>
                    `;
                    document.getElementById('youtubePreview').classList.remove('hidden');
                }
            }
        }

        function removeYoutube() {
            document.getElementById('youtube_embed_code').value = '';
            document.getElementById('youtubePreview').classList.add('hidden');
            document.getElementById('previewYoutube').innerHTML = '';
        }

        // Add event listener for YouTube embed code changes
        document.addEventListener('DOMContentLoaded', function() {
            const youtubeTextarea = document.getElementById('youtube_embed_code');
            if (youtubeTextarea) {
                youtubeTextarea.addEventListener('input', function() {
                    // Debounce the preview function
                    clearTimeout(this.previewTimeout);
                    this.previewTimeout = setTimeout(previewYoutube, 1000);
                });
            }
        });
    </script>
@endsection
