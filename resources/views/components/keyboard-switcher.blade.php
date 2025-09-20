@props(['name' => 'input_method', 'value' => 'avro', 'class' => '', 'showInstructions' => true])

<div class="keyboard-switcher {{ $class }}">
    <!-- Hidden input to maintain form compatibility -->
    <input type="hidden" name="{{ $name }}" value="avro">

    @if ($showInstructions)
        <!-- Bengali Writing Instruction -->
        <div class="text-xs text-gray-600 bg-blue-50 p-3 rounded-md mb-2 border-l-4 border-blue-500">
            <div class="flex items-start">
                <svg class="w-4 h-4 text-blue-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <div>
                    <strong>বাংলা টাইপ করার জন্য:</strong> <kbd
                        class="px-1.5 py-0.5 text-xs font-semibold text-gray-800 bg-gray-100 border border-gray-200 rounded">Ctrl
                        + Space</kbd> চাপুন এবং Avro বা UniJoy সিলেক্ট করুন।
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    // Initialize Bengali input attributes
    document.addEventListener('DOMContentLoaded', function() {
        const banglaInputs = document.querySelectorAll('.bangla-input, [data-bangla="true"]');
        banglaInputs.forEach(input => {
            input.setAttribute('lang', 'bn');
            input.setAttribute('inputmode', 'text');

            // Set placeholder if not already set
            if (!input.placeholder || input.placeholder === '') {
                input.placeholder = 'বাংলায় টাইপ করুন...';
            }
        });
    });
</script>

<style>
    .bangla-input {
        font-family: 'Kalpurush', 'SolaimanLipi', 'Bangla', 'Noto Sans Bengali', sans-serif;
        direction: ltr;
        unicode-bidi: bidi-override;
        font-size: 16px;
        transition: all 0.3s ease;
        border-left: 4px solid #3B82F6;
        background-color: #f8fafc;
        border-color: #3B82F6;
    }

    .bangla-input:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    kbd {
        font-family: 'Courier New', monospace;
    }
</style>
