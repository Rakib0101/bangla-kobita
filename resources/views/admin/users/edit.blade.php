@extends('layouts.admin')

@section('title', 'Edit User')
@section('page-title', 'ইউজার সম্পাদনা করুন')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white shadow rounded-lg p-6">
            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            নাম (English) <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="name_bangla" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                            নাম (বাংলা)
                        </label>
                        <input type="text" id="name_bangla" name="name_bangla"
                            value="{{ old('name_bangla', $user->name_bangla) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bangla-text">
                        @error('name_bangla')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        ইমেইল <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-2 bangla-text">
                            ভূমিকা <span class="text-red-500">*</span>
                        </label>
                        <select id="role" name="role"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>ইউজার</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>অ্যাডমিন
                            </option>
                        </select>
                        @error('role')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <div class="flex items-center">
                            <input type="checkbox" id="is_active" name="is_active" value="1"
                                {{ old('is_active', $user->is_active) ? 'checked' : '' }}
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="is_active" class="ml-2 block text-sm text-gray-900 bangla-text">
                                সক্রিয়
                            </label>
                        </div>
                    </div>
                </div>

                <!-- User Statistics -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-medium text-gray-900 mb-3 bangla-text">ইউজার পরিসংখ্যান</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <p class="text-sm text-gray-600 bangla-text">মোট কবিতা:</p>
                            <p class="text-2xl font-bold text-blue-600">{{ $user->poems()->count() }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 bangla-text">প্রকাশিত কবিতা:</p>
                            <p class="text-2xl font-bold text-green-600">
                                {{ $user->poems()->where('is_published', true)->count() }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 bangla-text">খসড়া কবিতা:</p>
                            <p class="text-2xl font-bold text-yellow-600">
                                {{ $user->poems()->where('is_published', false)->count() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Account Information -->
                <div class="bg-blue-50 rounded-lg p-4">
                    <h3 class="text-lg font-medium text-gray-900 mb-3 bangla-text">অ্যাকাউন্ট তথ্য</h3>
                    <dl class="space-y-2">
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500 bangla-text">যোগদানের তারিখ:</dt>
                            <dd class="text-sm text-gray-900">{{ $user->created_at->format('d M Y, h:i A') }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500 bangla-text">সর্বশেষ আপডেট:</dt>
                            <dd class="text-sm text-gray-900">{{ $user->updated_at->format('d M Y, h:i A') }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500 bangla-text">ইমেইল যাচাইকরণ:</dt>
                            <dd class="text-sm">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $user->email_verified_at ? 'যাচাইকৃত' : 'অযাচাইকৃত' }}
                                </span>
                            </dd>
                        </div>
                    </dl>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.users.show', $user) }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded bangla-text">
                        বাতিল
                    </a>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded bangla-text">
                        আপডেট করুন
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
