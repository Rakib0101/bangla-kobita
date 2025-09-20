@extends('layouts.bangla-app')

@section('content')
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900 bangla-text">
                    সদস্য হিসাবে যোগ দিন
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600 bangla-text">
                    বাংলা কবিতার আসরে আপনার স্বাগতম
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                        নাম <span class="text-red-500">*</span>
                    </label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                        autocomplete="name"
                        class="block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600 bangla-text">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Name in Bangla -->
                <div>
                    <label for="name_bangla" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                        নাম (বাংলায়)
                    </label>
                    <input id="name_bangla" type="text" name="name_bangla" value="{{ old('name_bangla') }}"
                        autocomplete="name"
                        class="block w-full bangla-input border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="আপনার নাম বাংলায় লিখুন...">
                    @error('name_bangla')
                        <p class="mt-1 text-sm text-red-600 bangla-text">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                        ইমেইল ঠিকানা <span class="text-red-500">*</span>
                    </label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        autocomplete="username"
                        class="block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600 bangla-text">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                        পাসওয়ার্ড <span class="text-red-500">*</span>
                    </label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600 bangla-text">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                        পাসওয়ার্ড নিশ্চিত করুন <span class="text-red-500">*</span>
                    </label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        autocomplete="new-password"
                        class="block w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Input Method Selection -->
                <x-keyboard-switcher name="input_method" value="{{ old('input_method', 'avro') }}" />

                <!-- Terms and Conditions -->
                <div class="flex items-center">
                    <input id="terms" type="checkbox" name="terms" required
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="terms" class="ml-2 block text-sm text-gray-700 bangla-text">
                        আমি <a href="#" class="text-blue-600 hover:text-blue-500">শর্তাবলী</a> এবং <a href="#"
                            class="text-blue-600 hover:text-blue-500">গোপনীয়তা নীতি</a> মেনে চলতে সম্মত
                    </label>
                </div>

                <div class="flex items-center justify-between">
                    <a class="text-sm text-blue-600 hover:text-blue-500 bangla-text" href="{{ route('login') }}">
                        ইতিমধ্যে অ্যাকাউন্ট আছে? লগ ইন করুন
                    </a>

                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded bangla-text">
                        রেজিস্ট্রেশন করুন
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
