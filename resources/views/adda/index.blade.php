@extends('layouts.bangla-app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 bangla-text">আড্ডা</h1>
                    <p class="text-gray-600 bangla-text mt-2">কবি ও কবিতা প্রেমীদের আড্ডার আসর</p>
                </div>
                <div class="text-sm text-gray-500 bangla-text">
                    <span id="online-count">অনলাইন: {{ rand(5, 25) }}</span>
                </div>
            </div>
        </div>

        <!-- Chat Container -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Messages Area -->
            <div id="messages-container" class="h-96 overflow-y-auto p-6 space-y-4">
                @foreach ($messages as $message)
                    <div class="flex {{ $message->user_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                        <div
                            class="max-w-xs lg:max-w-md px-4 py-2 rounded-lg {{ $message->user_id === auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800' }}">
                            <div class="flex items-center mb-1">
                                <span class="text-xs font-medium bangla-text">
                                    {{ $message->user->name_bangla ?? $message->user->name }}
                                </span>
                                <span class="text-xs ml-2 opacity-75">
                                    {{ $message->time_ago }}
                                </span>
                            </div>
                            <div class="bangla-text text-sm">
                                {{ $message->message_bangla }}
                            </div>
                            @if ($message->message_english)
                                <div class="text-xs mt-1 opacity-75 italic">
                                    {{ $message->message_english }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Message Input -->
            <div class="border-t border-gray-200 p-4">
                <form id="message-form" method="POST" action="{{ route('adda.store') }}" class="flex space-x-4">
                    @csrf
                    <div class="flex-1">
                        <textarea id="message-input" name="message_bangla" rows="2"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 bangla-text"
                            placeholder="আপনার বার্তা লিখুন..." required></textarea>
                    </div>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded bangla-text">
                        পাঠান
                    </button>
                </form>
            </div>
        </div>

        <!-- Guidelines -->
        <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <h3 class="text-sm font-medium text-yellow-800 bangla-text mb-2">আড্ডার নিয়ম:</h3>
            <ul class="text-xs text-yellow-700 bangla-text space-y-1">
                <li>• সবাইকে সম্মান করুন এবং ভদ্র ভাষা ব্যবহার করুন</li>
                <li>• কবিতা, সাহিত্য এবং সংস্কৃতি নিয়ে আলোচনা করুন</li>
                <li>• ব্যক্তিগত আক্রমণ বা অপ্রাসঙ্গিক আলোচনা এড়িয়ে চলুন</li>
                <li>• অ্যাডমিনরা অপ্রাসঙ্গিক বার্তা মুছে দিতে পারেন</li>
            </ul>
        </div>
    </div>

    <script>
        // Auto-scroll to bottom
        function scrollToBottom() {
            const container = document.getElementById('messages-container');
            container.scrollTop = container.scrollHeight;
        }

        // Scroll to bottom on page load
        document.addEventListener('DOMContentLoaded', function() {
            scrollToBottom();
        });

        // Simple form submission - no AJAX, just regular form submit
        document.getElementById('message-form').addEventListener('submit', function(e) {
            const messageInput = document.getElementById('message-input');

            // Check if message is not empty
            if (messageInput.value.trim() === '') {
                e.preventDefault();
                alert('বার্তা লিখুন');
                return false;
            }

            // Let the form submit normally
            return true;
        });
    </script>
@endsection
