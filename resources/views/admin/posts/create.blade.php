@extends('layouts.bangla-app')

@section('head')
    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
@endsection

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md p-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold bangla-text">নতুন পোস্ট লিখুন (অ্যাডমিন)</h1>
                <a href="{{ route('admin.posts') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded bangla-text">
                    পোস্টের তালিকায় ফিরে যান
                </a>
            </div>

            <form method="POST" action="{{ route('admin.posts.store') }}" class="space-y-6">
                @csrf

                <!-- Writer Selection -->
                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                        লেখকের নাম নির্বাচন করুন <span class="text-red-500">*</span>
                    </label>
                    <select id="user_id" name="user_id"
                        class="block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        required>
                        <option value="">লেখক নির্বাচন করুন</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name_bangla ?? $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="mt-1 text-sm text-red-600 bangla-text">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Poem Title in Bangla -->
                <div>
                    <label for="title_bangla" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                        পোস্টের শিরোনাম (বাংলায়) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="title_bangla" name="title_bangla" value="{{ old('title_bangla') }}"
                        class="block w-full bangla-input border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="পোস্টের শিরোনাম লিখুন..." required>
                    @error('title_bangla')
                        <p class="mt-1 text-sm text-red-600 bangla-text">{{ $message }}</p>
                    @enderror
                </div>


                <!-- Category Selection -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                        পোস্টের বিভাগ <span class="text-red-500">*</span>
                    </label>
                    <select id="category_id" name="category_id"
                        class="block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        required>
                        <option value="">বিভাগ নির্বাচন করুন</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name_bangla }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-600 bangla-text">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Original Writer Selection (if translation) -->
                <div>
                    <label for="poet_id" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                        মূল লেখক (যদি অনুবাদ হয়)
                    </label>
                    <select id="poet_id" name="poet_id"
                        class="block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">মূল লেখক নির্বাচন করুন</option>
                        @foreach ($poets as $poet)
                            <option value="{{ $poet->id }}" {{ old('poet_id') == $poet->id ? 'selected' : '' }}>
                                {{ $poet->name_bangla }}
                            </option>
                        @endforeach
                    </select>
                    @error('poet_id')
                        <p class="mt-1 text-sm text-red-600 bangla-text">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Poem Content in Bangla -->
                <div>
                    <label for="content_bangla" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                        পোস্টের বিষয়বস্তু (বাংলায়) <span class="text-red-500">*</span>
                    </label>
                    <textarea id="content_bangla" name="content_bangla" rows="15"
                        class="block w-full bangla-input border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="আপনার পোস্ট এখানে লিখুন..." required>{{ old('content_bangla') }}</textarea>
                    @error('content_bangla')
                        <p class="mt-1 text-sm text-red-600 bangla-text">{{ $message }}</p>
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
                        <p class="mt-1 text-sm text-red-600 bangla-text">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Keyboard Switcher for Bengali Input -->
                <x-keyboard-switcher name="input_method" value="{{ old('input_method', 'avro') }}" />

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
                    <a href="{{ route('admin.posts') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded bangla-text">
                        বাতিল
                    </a>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded bangla-text">
                        পোস্ট সংরক্ষণ করুন
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize CKEditor
            ClassicEditor
                .create(document.querySelector('#content_bangla'), {
                    toolbar: {
                        items: [
                            'heading', '|',
                            'bold', 'italic', 'underline', '|',
                            'bulletedList', 'numberedList', '|',
                            'outdent', 'indent', '|',
                            'link', 'blockQuote', 'insertTable', '|',
                            'undo', 'redo'
                        ]
                    },
                    language: 'bn',
                    table: {
                        contentToolbar: [
                            'tableColumn',
                            'tableRow',
                            'mergeTableCells'
                        ]
                    }
                })
                .then(editor => {
                    // Set Bengali font
                    editor.editing.view.change(writer => {
                        writer.setStyle('font-family',
                            'AbuJMAkkas, Kalpurush, SolaimanLipi, Bangla, Noto Sans Bengali, sans-serif',
                            editor.editing.view.document.getRoot());
                        writer.setStyle('font-size', '16px', editor.editing.view.document.getRoot());
                    });

                    // Update form data when editor content changes
                    editor.model.document.on('change:data', () => {
                        document.querySelector('#content_bangla').value = editor.getData();
                    });
                })
                .catch(error => {
                    console.error('Error initializing CKEditor:', error);
                });
        });
    </script>
@endsection
