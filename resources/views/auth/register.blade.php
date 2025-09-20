<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    সদস্য হিসাবে যোগ দিন
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    বাংলা কবিতার আসরে আপনার স্বাগতম
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-6">
                @csrf

                <!-- Login Name -->
                <div>
                    <x-input-label for="login_name" :value="__('লগইন নাম')" />
                    <x-text-input id="login_name" class="block mt-1 w-full" type="text" name="login_name"
                        :value="old('login_name')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('login_name')" class="mt-2" />
                </div>

                <!-- Bangla Name with Input Method Selection -->
                <div>
                    <x-input-label for="name_bangla" :value="__('আপনার নাম (বাংলায়)')" />

                    <!-- Keyboard Switcher Component -->
                    <x-keyboard-switcher name="input_method" value="{{ old('input_method', 'avro') }}" />

                    <input id="name_bangla" class="block mt-1 w-full bangla-input" type="text" name="name_bangla"
                        value="{{ old('name_bangla') }}" required autocomplete="name"
                        placeholder="অভ্রে টাইপ করুন..." />
                    <x-input-error :messages="$errors->get('name_bangla')" class="mt-2" />
                </div>

                <!-- English Name -->
                <div>
                    <x-input-label for="name_english" :value="__('আপনার নাম (ইংরেজিতে)')" />
                    <x-text-input id="name_english" class="block mt-1 w-full" type="text" name="name_english"
                        :value="old('name_english')" required autocomplete="name" />
                    <x-input-error :messages="$errors->get('name_english')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('ইমেইল')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('পাসওয়ার্ড')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('পুনরায় পাসওয়ার্ড')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Account Status Question -->
                <div>
                    <x-input-label :value="__('আপনার আর কোন একাউন্ট আছে এখানে?')" />
                    <div class="mt-2 flex space-x-4">
                        <label class="inline-flex items-center">
                            <input type="radio" name="has_other_account" value="yes" class="form-radio"
                                {{ old('has_other_account') == 'yes' ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-700">হ্যাঁ</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="has_other_account" value="no" class="form-radio"
                                {{ old('has_other_account', 'no') == 'no' ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-700">না</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="has_other_account" value="inactive" class="form-radio"
                                {{ old('has_other_account') == 'inactive' ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-700">নিষ্ক্রিয়</span>
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('has_other_account')" class="mt-2" />
                </div>

                <!-- Warning Box -->
                <div class="bg-red-50 border border-red-200 rounded-md p-4">
                    <p class="text-sm text-red-800">
                        এখানে 'না' বলার পরেও যদি পরবর্তীকালে একাধিক আইডি পাওয়া যায়, তাহলে নতুন একাউন্টসহ সংশ্লিষ্ট
                        সমস্ত একাউন্ট ব্যান করা হবে।
                    </p>
                </div>

                <!-- Declaration Section -->
                <div>
                    <x-input-label :value="__('প্রত্যায়ন')" />
                    <div class="mt-2 bg-yellow-50 border border-yellow-200 rounded-md p-4">
                        <p class="text-sm text-gray-800">
                            আসরে সদস্য হিসাবে যোগ দেয়ার মানে হচ্ছে আপনি প্রত্যায়ন করছেন যে আসরের সমস্ত নিয়মাবলী মেনে
                            চলবেন। ইতিমধ্যে আমাদের নিয়মাবলী পড়ে না থাকলে নিয়মাবলী পড়তে
                            <a href="#" class="underline text-blue-600 hover:text-blue-800">এখানে ক্লিক
                                করুন</a>।
                            নিয়মাবলীর কোন অংশে আপনার আপত্তি থাকলে সদস্য হওয়া থেকে বিরত থাকুন।
                        </p>
                    </div>

                    <div class="mt-3">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="terms_accepted" value="1" class="form-checkbox"
                                {{ old('terms_accepted') ? 'checked' : '' }} required>
                            <span class="ml-2 text-sm text-gray-700">আমি নিয়মাবলী পড়েছি এবং গ্রহণ করছি</span>
                        </label>
                        <x-input-error :messages="$errors->get('terms_accepted')" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('login') }}">
                        {{ __('ইতিমধ্যে নিবন্ধিত?') }}
                    </a>

                    <x-primary-button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('যোগ দিন') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

</x-guest-layout>
