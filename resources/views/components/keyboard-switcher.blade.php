@props(['name' => 'input_method', 'value' => 'avro', 'class' => ''])

<div class="keyboard-switcher {{ $class }}">
    <div class="flex space-x-4 mb-2">
        <label class="inline-flex items-center cursor-pointer">
            <input type="radio" 
                   name="{{ $name }}" 
                   value="english" 
                   class="form-radio text-blue-600" 
                   {{ old($name, $value) == 'english' ? 'checked' : '' }}
                   onchange="switchKeyboardLayout('english')">
            <span class="ml-2 text-sm text-gray-700 font-medium">ইংরেজি</span>
        </label>
        <label class="inline-flex items-center cursor-pointer">
            <input type="radio" 
                   name="{{ $name }}" 
                   value="avro" 
                   class="form-radio text-blue-600" 
                   {{ old($name, $value) == 'avro' ? 'checked' : '' }}
                   onchange="switchKeyboardLayout('avro')">
            <span class="ml-2 text-sm text-gray-700 font-medium">অভ্র</span>
        </label>
        <label class="inline-flex items-center cursor-pointer">
            <input type="radio" 
                   name="{{ $name }}" 
                   value="unijoy" 
                   class="form-radio text-blue-600" 
                   {{ old($name, $value) == 'unijoy' ? 'checked' : '' }}
                   onchange="switchKeyboardLayout('unijoy')">
            <span class="ml-2 text-sm text-gray-700 font-medium">ইউনিজয়</span>
        </label>
    </div>
    
    <!-- Keyboard Layout Indicator -->
    <div class="keyboard-indicator text-xs text-gray-500 mb-2">
        <span id="keyboard-status">অভ্র কিবোর্ড সক্রিয়</span>
    </div>
</div>

<script>
    // Global keyboard switcher functionality
    window.switchKeyboardLayout = function(method) {
        // Update all Bangla input fields
        const banglaInputs = document.querySelectorAll('.bangla-input, [data-bangla="true"]');
        const statusElement = document.getElementById('keyboard-status');
        
        banglaInputs.forEach(input => {
            // Remove existing keyboard classes
            input.classList.remove('keyboard-english', 'keyboard-avro', 'keyboard-unijoy');
            
            // Add appropriate keyboard class
            input.classList.add('keyboard-' + method);
            
            // Set input method attribute
            input.setAttribute('data-input-method', method);
            
            // Update placeholder
            const placeholders = {
                'avro': 'অভ্রে টাইপ করুন...',
                'unijoy': 'ইউনিজয়ে টাইপ করুন...',
                'english': 'ইংরেজিতে টাইপ করুন...'
            };
            
            if (input.placeholder === '' || placeholders[input.getAttribute('data-input-method')]) {
                input.placeholder = placeholders[method];
            }
        });
        
        // Update status indicator
        if (statusElement) {
            const statusTexts = {
                'avro': 'অভ্র কিবোর্ড সক্রিয়',
                'unijoy': 'ইউনিজয় কিবোর্ড সক্রিয়',
                'english': 'ইংরেজি কিবোর্ড সক্রিয়'
            };
            statusElement.textContent = statusTexts[method];
        }
        
        // Store preference in localStorage
        localStorage.setItem('preferred_keyboard', method);
    };
    
    // Initialize keyboard layout on page load
    document.addEventListener('DOMContentLoaded', function() {
        const savedMethod = localStorage.getItem('preferred_keyboard') || 'avro';
        const radioButton = document.querySelector(`input[name="{{ $name }}"][value="${savedMethod}"]`);
        
        if (radioButton) {
            radioButton.checked = true;
            switchKeyboardLayout(savedMethod);
        } else {
            // Default to avro
            switchKeyboardLayout('avro');
        }
    });
    
    // Add visual feedback for keyboard switching
    document.addEventListener('keydown', function(e) {
        const activeInput = document.activeElement;
        if (activeInput && activeInput.classList.contains('bangla-input')) {
            const method = activeInput.getAttribute('data-input-method');
            if (method) {
                activeInput.style.borderColor = method === 'avro' ? '#3B82F6' : 
                                             method === 'unijoy' ? '#10B981' : '#6B7280';
            }
        }
    });
</script>

<style>
    .keyboard-switcher .form-radio {
        width: 16px;
        height: 16px;
        border: 2px solid #d1d5db;
        border-radius: 50%;
        transition: all 0.2s ease;
    }
    
    .keyboard-switcher .form-radio:checked {
        border-color: #3b82f6;
        background-color: #3b82f6;
    }
    
    .keyboard-switcher .form-radio:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .keyboard-indicator {
        padding: 4px 8px;
        background-color: #f3f4f6;
        border-radius: 4px;
        display: inline-block;
    }
    
    .bangla-input.keyboard-avro,
    .bangla-input.keyboard-unijoy {
        font-family: 'Kalpurush', 'SolaimanLipi', 'Bangla', 'Noto Sans Bengali', sans-serif;
        direction: ltr;
        unicode-bidi: bidi-override;
        font-size: 16px;
    }
    
    .bangla-input.keyboard-english {
        font-family: 'Arial', 'Helvetica', sans-serif;
        direction: ltr;
    }
    
    .bangla-input {
        transition: all 0.3s ease;
    }
    
    .bangla-input:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
</style>
