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

                    <!-- Input Method Selection -->
                    <div class="mt-2">
                        <div class="flex space-x-4 mb-2">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="radio" name="input_method" value="english" class="form-radio"
                                    {{ old('input_method') == 'english' ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-700 font-medium">ইংরেজি</span>
                            </label>
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="radio" name="input_method" value="avro" class="form-radio"
                                    {{ old('input_method', 'avro') == 'avro' ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-700 font-medium">অভ্র</span>
                            </label>
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="radio" name="input_method" value="unijoy" class="form-radio"
                                    {{ old('input_method') == 'unijoy' ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-700 font-medium">ইউনিজয়</span>
                            </label>
                        </div>

                        <!-- Input Method Instructions -->
                        <div id="input-instructions" class="text-xs text-gray-600 bg-blue-50 p-2 rounded-md">
                            <div id="avro-instructions" class="hidden">
                                <strong>অভ্র কিবোর্ড:</strong> ইংরেজিতে টাইপ করুন, স্বয়ংক্রিয়ভাবে বাংলায় রূপান্তর
                                হবে। উদাহরণ: "ami" → "আমি"
                            </div>
                            <div id="unijoy-instructions" class="hidden">
                                <strong>ইউনিজয় কিবোর্ড:</strong> ইংরেজিতে টাইপ করুন, স্বয়ংক্রিয়ভাবে বাংলায় রূপান্তর
                                হবে। উদাহরণ: "ami" → "আমি"
                            </div>
                            <div id="english-instructions" class="hidden">
                                <strong>ইংরেজি কিবোর্ড:</strong> ইংরেজি কিবোর্ডে টাইপ করুন
                            </div>
                        </div>
                    </div>

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

    <!-- Enhanced Keyboard Switcher Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputMethodRadios = document.querySelectorAll('input[name="input_method"]');
            const banglaInputs = document.querySelectorAll('.bangla-input');

            // Simple English to Bangla conversion mapping (Avro style)
            const avroMapping = {
                'a': 'আ',
                'b': 'ব',
                'c': 'চ',
                'd': 'ড',
                'e': 'ই',
                'f': 'ফ',
                'g': 'গ',
                'h': 'হ',
                'i': 'ই',
                'j': 'জ',
                'k': 'ক',
                'l': 'ল',
                'm': 'ম',
                'n': 'ন',
                'o': 'ও',
                'p': 'প',
                'q': 'ক',
                'r': 'র',
                's': 'স',
                't': 'ট',
                'u': 'উ',
                'v': 'ভ',
                'w': 'ও',
                'x': 'এক্স',
                'y': 'ই',
                'z': 'জ',
                // Common words
                'ami': 'আমি',
                'tumi': 'তুমি',
                'se': 'সে',
                'amra': 'আমরা',
                'tomra': 'তোমরা',
                'tara': 'তারা',
                'ek': 'এক',
                'dui': 'দুই',
                'tin': 'তিন',
                'char': 'চার',
                'panch': 'পাঁচ',
                'choy': 'ছয়',
                'shat': 'সাত',
                'at': 'আট',
                'noy': 'নয়',
                'dash': 'দশ',
                'bhalo': 'ভালো',
                'kharap': 'খারাপ',
                'bari': 'বাড়ি',
                'ghor': 'ঘর',
                'jol': 'জল',
                'khabar': 'খাবার',
                'kotha': 'কথা'
            };

            // Function to convert English to Bangla (simplified)
            function convertToBangla(text, method) {
                if (method === 'english') return text;

                let result = text;

                // Convert common words first
                for (let [eng, bang] of Object.entries(avroMapping)) {
                    const regex = new RegExp('\\b' + eng + '\\b', 'gi');
                    result = result.replace(regex, bang);
                }

                // Convert individual characters
                for (let [eng, bang] of Object.entries(avroMapping)) {
                    if (eng.length === 1) {
                        result = result.replace(new RegExp(eng, 'g'), bang);
                    }
                }

                return result;
            }

            // Function to switch keyboard layout
            function switchKeyboardLayout(method) {
                console.log('Switching to:', method);

                // Hide all instruction divs
                document.querySelectorAll('#input-instructions > div').forEach(div => {
                    div.classList.add('hidden');
                });

                // Show the appropriate instruction
                const instructionDiv = document.getElementById(method + '-instructions');
                if (instructionDiv) {
                    instructionDiv.classList.remove('hidden');
                }

                banglaInputs.forEach(input => {
                    // Remove existing keyboard classes
                    input.classList.remove('keyboard-english', 'keyboard-avro', 'keyboard-unijoy');

                    // Add appropriate keyboard class
                    input.classList.add('keyboard-' + method);

                    // Set input method attribute for CSS styling
                    input.setAttribute('data-input-method', method);

                    // Update placeholder
                    const placeholders = {
                        'avro': 'ইংরেজিতে টাইপ করুন, স্বয়ংক্রিয়ভাবে বাংলায় রূপান্তর হবে',
                        'unijoy': 'ইংরেজিতে টাইপ করুন, স্বয়ংক্রিয়ভাবে বাংলায় রূপান্তর হবে',
                        'english': 'ইংরেজিতে টাইপ করুন...'
                    };
                    input.placeholder = placeholders[method] || '';

                    // Set input mode for mobile devices
                    if (method === 'english') {
                        input.setAttribute('inputmode', 'latin');
                        input.setAttribute('lang', 'en');
                    } else {
                        input.setAttribute('inputmode', 'text');
                        input.setAttribute('lang', 'bn');
                    }
                });
            }

            // Listen for input method changes
            inputMethodRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    console.log('Radio changed to:', this.value);
                    if (this.checked) {
                        switchKeyboardLayout(this.value);
                    }
                });
            });

            // Initialize with default method
            const defaultMethod = document.querySelector('input[name="input_method"]:checked');
            if (defaultMethod) {
                console.log('Default method:', defaultMethod.value);
                switchKeyboardLayout(defaultMethod.value);
            } else {
                // Fallback to avro if no default is found
                switchKeyboardLayout('avro');
            }

            // Add real-time conversion for Bangla inputs
            banglaInputs.forEach(input => {
                input.addEventListener('input', function() {
                    const method = this.getAttribute('data-input-method');

                    if (method === 'avro' || method === 'unijoy') {
                        // Get cursor position
                        const cursorPos = this.selectionStart;
                        const currentValue = this.value;

                        // Convert to Bangla
                        const convertedValue = convertToBangla(currentValue, method);

                        // Only update if conversion changed something
                        if (convertedValue !== currentValue) {
                            this.value = convertedValue;
                            // Restore cursor position
                            this.setSelectionRange(cursorPos, cursorPos);
                        }

                        // Visual feedback
                        this.style.borderLeftColor = method === 'avro' ? '#10B981' : '#3B82F6';
                        this.style.backgroundColor = method === 'avro' ? '#f0fdf4' : '#eff6ff';
                    } else {
                        this.style.borderLeftColor = '#6B7280';
                        this.style.backgroundColor = '#f9fafb';
                    }
                });

                input.addEventListener('focus', function() {
                    const method = this.getAttribute('data-input-method') || 'avro';
                    const placeholders = {
                        'avro': 'ইংরেজিতে টাইপ করুন, স্বয়ংক্রিয়ভাবে বাংলায় রূপান্তর হবে',
                        'unijoy': 'ইংরেজিতে টাইপ করুন, স্বয়ংক্রিয়ভাবে বাংলায় রূপান্তর হবে',
                        'english': 'ইংরেজিতে টাইপ করুন...'
                    };
                    this.placeholder = placeholders[method] || '';
                });
            });
        });
    </script>

    <!-- Keyboard Switcher Styles -->
    <style>
        .keyboard-avro {
            font-family: 'Kalpurush', 'SolaimanLipi', 'Bangla', 'Noto Sans Bengali', sans-serif !important;
            direction: ltr;
            unicode-bidi: bidi-override;
            font-size: 16px !important;
        }

        .keyboard-unijoy {
            font-family: 'Kalpurush', 'SolaimanLipi', 'Bangla', 'Noto Sans Bengali', sans-serif !important;
            direction: ltr;
            unicode-bidi: bidi-override;
            font-size: 16px !important;
        }

        .keyboard-english {
            font-family: 'Arial', 'Helvetica', sans-serif !important;
            font-size: 16px !important;
        }

        .bangla-input {
            font-size: 16px;
            padding: 12px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .bangla-input:focus {
            border-color: #3b82f6;
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-radio {
            margin-right: 8px;
            width: 16px;
            height: 16px;
        }

        .form-checkbox {
            margin-right: 8px;
            width: 16px;
            height: 16px;
        }

        /* Visual feedback for keyboard switching */
        .bangla-input.keyboard-avro {
            border-left: 4px solid #10B981;
            background-color: #f0fdf4;
            border-color: #10B981;
        }

        .bangla-input.keyboard-unijoy {
            border-left: 4px solid #3B82F6;
            background-color: #eff6ff;
            border-color: #3B82F6;
        }

        .bangla-input.keyboard-english {
            border-left: 4px solid #6B7280;
            background-color: #f9fafb;
            border-color: #6B7280;
        }

        /* Radio button styling */
        .form-radio:checked {
            background-color: #3B82F6;
            border-color: #3B82F6;
        }

        .form-radio:checked+span {
            color: #1f2937;
            font-weight: 600;
        }

        /* Instruction box styling */
        #input-instructions {
            border-left: 4px solid #3B82F6;
            margin-top: 8px;
        }

        #avro-instructions {
            border-left-color: #10B981;
        }

        #unijoy-instructions {
            border-left-color: #3B82F6;
        }

        #english-instructions {
            border-left-color: #6B7280;
        }
    </style>
</x-guest-layout>
