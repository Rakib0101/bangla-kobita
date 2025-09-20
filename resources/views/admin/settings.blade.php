@extends('layouts.admin')

@section('title', 'Website Settings')
@section('page-title', 'ওয়েবসাইট সেটিংস')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Settings Tabs -->
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8">
                <button id="general-tab"
                    class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm border-blue-500 text-blue-600 bangla-text">
                    সাধারণ সেটিংস
                </button>
                <button id="appearance-tab"
                    class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 bangla-text">
                    চেহারা
                </button>
                <button id="seo-tab"
                    class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 bangla-text">
                    SEO সেটিংস
                </button>
                <button id="email-tab"
                    class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 bangla-text">
                    ইমেইল সেটিংস
                </button>
            </nav>
        </div>

        <!-- General Settings -->
        <div id="general-content" class="tab-content">
            <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4 bangla-text">সাধারণ তথ্য</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="site_name" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                                সাইটের নাম
                            </label>
                            <input type="text" id="site_name" name="site_name"
                                value="{{ old('site_name', 'বাংলা কবিতা') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bangla-text">
                            @error('site_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="site_tagline" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                                সাইটের ট্যাগলাইন
                            </label>
                            <input type="text" id="site_tagline" name="site_tagline"
                                value="{{ old('site_tagline', 'কবিতার আসর') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bangla-text">
                            @error('site_tagline')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="site_description" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                            সাইটের বর্ণনা
                        </label>
                        <textarea id="site_description" name="site_description" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bangla-text">{{ old('site_description', 'বাংলা কবিতার সংগ্রহ এবং প্রকাশের প্ল্যাটফর্ম') }}</textarea>
                        @error('site_description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4 bangla-text">লোগো এবং ছবি</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="site_logo" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                                সাইট লোগো
                            </label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="site_logo"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span class="bangla-text">ফাইল নির্বাচন করুন</span>
                                            <input id="site_logo" name="site_logo" type="file" class="sr-only"
                                                accept="image/*">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500 bangla-text">PNG, JPG, GIF পর্যন্ত 10MB</p>
                                </div>
                            </div>
                            @error('site_logo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="favicon" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                                ফেভিকন
                            </label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="favicon"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span class="bangla-text">ফাইল নির্বাচন করুন</span>
                                            <input id="favicon" name="favicon" type="file" class="sr-only"
                                                accept="image/*">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500 bangla-text">ICO, PNG পর্যন্ত 2MB</p>
                                </div>
                            </div>
                            @error('favicon')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4 bangla-text">সামাজিক যোগাযোগ</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="facebook_url" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                                Facebook URL
                            </label>
                            <input type="url" id="facebook_url" name="facebook_url" value="{{ old('facebook_url') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('facebook_url')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="twitter_url" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                                Twitter URL
                            </label>
                            <input type="url" id="twitter_url" name="twitter_url" value="{{ old('twitter_url') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('twitter_url')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="instagram_url" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                                Instagram URL
                            </label>
                            <input type="url" id="instagram_url" name="instagram_url"
                                value="{{ old('instagram_url') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('instagram_url')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="youtube_url" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                                YouTube URL
                            </label>
                            <input type="url" id="youtube_url" name="youtube_url" value="{{ old('youtube_url') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @error('youtube_url')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded bangla-text">
                        সেটিংস সংরক্ষণ করুন
                    </button>
                </div>
            </form>
        </div>

        <!-- Appearance Settings -->
        <div id="appearance-content" class="tab-content hidden">
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4 bangla-text">থিম সেটিংস</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2 bangla-text">প্রাথমিক রঙ</label>
                        <div class="flex space-x-2">
                            <button type="button"
                                class="w-8 h-8 bg-blue-600 rounded-full border-2 border-gray-300"></button>
                            <button type="button"
                                class="w-8 h-8 bg-green-600 rounded-full border-2 border-transparent"></button>
                            <button type="button"
                                class="w-8 h-8 bg-purple-600 rounded-full border-2 border-transparent"></button>
                            <button type="button"
                                class="w-8 h-8 bg-red-600 rounded-full border-2 border-transparent"></button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2 bangla-text">ফন্ট সাইজ</label>
                        <select
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="small">ছোট</option>
                            <option value="medium" selected>মাঝারি</option>
                            <option value="large">বড়</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO Settings -->
        <div id="seo-content" class="tab-content hidden">
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4 bangla-text">SEO সেটিংস</h3>

                <div class="space-y-6">
                    <div>
                        <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                            Meta Title
                        </label>
                        <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                            Meta Description
                        </label>
                        <textarea id="meta_description" name="meta_description" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                    <div>
                        <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                            Meta Keywords
                        </label>
                        <input type="text" id="meta_keywords" name="meta_keywords"
                            value="{{ old('meta_keywords') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="কবিতা, বাংলা কবিতা, কবি">
                    </div>
                </div>
            </div>
        </div>

        <!-- Email Settings -->
        <div id="email-content" class="tab-content hidden">
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4 bangla-text">ইমেইল সেটিংস</h3>

                <div class="space-y-6">
                    <div>
                        <label for="admin_email" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                            অ্যাডমিন ইমেইল
                        </label>
                        <input type="email" id="admin_email" name="admin_email" value="{{ old('admin_email') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                            যোগাযোগ ইমেইল
                        </label>
                        <input type="email" id="contact_email" name="contact_email"
                            value="{{ old('contact_email') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="noreply_email" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                            No-Reply ইমেইল
                        </label>
                        <input type="email" id="noreply_email" name="noreply_email"
                            value="{{ old('noreply_email') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('scripts')
    <script>
        // Tab switching functionality
        const tabs = ['general', 'appearance', 'seo', 'email'];

        tabs.forEach(tab => {
            const tabButton = document.getElementById(`${tab}-tab`);
            const tabContent = document.getElementById(`${tab}-content`);

            tabButton.addEventListener('click', () => {
                // Remove active class from all tabs
                tabs.forEach(t => {
                    document.getElementById(`${t}-tab`).classList.remove('border-blue-500',
                        'text-blue-600');
                    document.getElementById(`${t}-tab`).classList.add('border-transparent',
                        'text-gray-500');
                    document.getElementById(`${t}-content`).classList.add('hidden');
                });

                // Add active class to clicked tab
                tabButton.classList.remove('border-transparent', 'text-gray-500');
                tabButton.classList.add('border-blue-500', 'text-blue-600');
                tabContent.classList.remove('hidden');
            });
        });
    </script>
@endsection
@endsection
