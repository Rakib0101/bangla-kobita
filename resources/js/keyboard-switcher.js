// Global Keyboard Switcher System
class BanglaKeyboardSwitcher {
    constructor() {
        this.avroMapping = {
            // Vowels and vowel combinations
            a: "আ",
            aa: "আ",
            i: "ই",
            ii: "ঈ",
            u: "উ",
            uu: "ঊ",
            e: "এ",
            ee: "ঈ",
            o: "ও",
            oo: "ঊ",
            ou: "ঔ",
            ai: "ঐ",
            au: "ঔ",

            // Consonants
            k: "ক",
            kh: "খ",
            g: "গ",
            gh: "ঘ",
            ng: "ঙ",
            c: "চ",
            ch: "ছ",
            j: "জ",
            jh: "ঝ",
            ny: "ঞ",
            t: "ট",
            th: "ঠ",
            d: "ড",
            dh: "ঢ",
            n: "ণ",
            p: "প",
            ph: "ফ",
            b: "ব",
            bh: "ভ",
            m: "ম",
            y: "য",
            r: "র",
            l: "ল",
            w: "ও",
            sh: "শ",
            s: "স",
            h: "হ",
            r: "ড়",
            rh: "ঢ়",
            y: "য়",

            // Common words with proper Avro phonetics
            ami: "আমি",
            tumi: "তুমি",
            se: "সে",
            amra: "আমরা",
            tomra: "তোমরা",
            tara: "তারা",
            ek: "এক",
            dui: "দুই",
            tin: "তিন",
            char: "চার",
            panch: "পাঁচ",
            choy: "ছয়",
            shat: "সাত",
            at: "আট",
            noy: "নয়",
            dash: "দশ",
            bhalo: "ভালো",
            kharap: "খারাপ",
            bari: "বাড়ি",
            ghor: "ঘর",
            jol: "জল",
            khabar: "খাবার",
            kotha: "কথা",
            kemon: "কেমন",
            kothay: "কোথায়",
            kobe: "কবে",
            keno: "কেন",
            ki: "কি",
            ke: "কে",
            kake: "কাকে",
            karo: "কারো",
            amar: "আমার",
            tomar: "তোমার",
            tar: "তার",
            amader: "আমাদের",
            tomader: "তোমাদের",
            tader: "তাদের",
            hobe: "হবে",
            hoyeche: "হয়েছে",
            kore: "করে",
            koreche: "করেছে",
            jabe: "যাবে",
            geche: "গেছে",
            kobita: "কবিতা",
            kobi: "কবি",
            bangla: "বাংলা",
            desh: "দেশ",
            manush: "মানুষ",
            jibon: "জীবন",
            prem: "প্রেম",
            maya: "মায়া",
        };

        this.init();
    }

    init() {
        // Initialize Bengali inputs with basic setup
        this.initializeInputs();
    }

    initializeSwitchers() {
        // Find all keyboard switcher components
        const switchers = document.querySelectorAll(".keyboard-switcher");

        switchers.forEach((switcher) => {
            const inputMethodRadios = switcher.querySelectorAll(
                'input[name="input_method"]'
            );
            const banglaInputs = document.querySelectorAll(
                '.bangla-input, [data-bangla="true"]'
            );

            // Add event listeners to radio buttons
            inputMethodRadios.forEach((radio) => {
                radio.addEventListener("change", (e) => {
                    this.switchKeyboardLayout(e.target.value, banglaInputs);
                });
            });

            // Initialize with default method
            const defaultMethod = switcher.querySelector(
                'input[name="input_method"]:checked'
            );
            if (defaultMethod) {
                this.switchKeyboardLayout(defaultMethod.value, banglaInputs);
            } else {
                this.switchKeyboardLayout("avro", banglaInputs);
            }
        });
    }

    initializeInputs() {
        // Find all Bangla input fields
        const banglaInputs = document.querySelectorAll(
            '.bangla-input, [data-bangla="true"]'
        );

        banglaInputs.forEach((input) => {
            // Set basic Bengali input attributes
            input.setAttribute("lang", "bn");
            input.setAttribute("inputmode", "text");

            // Set placeholder if not already set
            if (!input.placeholder || input.placeholder === "") {
                input.placeholder = "বাংলায় টাইপ করুন...";
            }
        });
    }

    switchKeyboardLayout(method, inputs = null) {
        const banglaInputs =
            inputs ||
            document.querySelectorAll('.bangla-input, [data-bangla="true"]');

        // Update all instruction divs
        document
            .querySelectorAll(
                "#input-instructions > div, .keyboard-instructions > div"
            )
            .forEach((div) => {
                div.classList.add("hidden");
            });

        // Show the appropriate instruction
        const instructionDiv = document.querySelector(
            `#${method}-instructions, .${method}-instructions`
        );
        if (instructionDiv) {
            instructionDiv.classList.remove("hidden");
        }

        // Also call the showInstruction function if it exists
        if (typeof showInstruction === "function") {
            showInstruction(method);
        }

        // Update all status indicators
        document
            .querySelectorAll('[id^="keyboard-status"]')
            .forEach((statusElement) => {
                const statusTexts = {
                    avro: "অভ্র কিবোর্ড সক্রিয়",
                    unijoy: "ইউনিজয় কিবোর্ড সক্রিয়",
                    english: "ইংরেজি কিবোর্ড সক্রিয়",
                };
                statusElement.textContent =
                    statusTexts[method] || "কিবোর্ড সক্রিয়";
            });

        banglaInputs.forEach((input) => {
            // Remove existing keyboard classes
            input.classList.remove(
                "keyboard-english",
                "keyboard-avro",
                "keyboard-unijoy"
            );

            // Add appropriate keyboard class
            input.classList.add("keyboard-" + method);

            // Set input method attribute
            input.setAttribute("data-input-method", method);

            // Update placeholder
            this.updatePlaceholder(input, method);

            // Set input mode for mobile devices
            if (method === "english") {
                input.setAttribute("inputmode", "latin");
                input.setAttribute("lang", "en");
            } else {
                input.setAttribute("inputmode", "text");
                input.setAttribute("lang", "bn");
            }
        });

        // Store preference in localStorage
        localStorage.setItem("preferred_keyboard", method);
    }

    updatePlaceholder(input, method = null) {
        const currentMethod =
            method || input.getAttribute("data-input-method") || "avro";

        const placeholders = {
            avro: "ইংরেজিতে টাইপ করুন, স্বয়ংক্রিয়ভাবে বাংলায় রূপান্তর হবে",
            unijoy: "ইংরেজিতে টাইপ করুন, স্বয়ংক্রিয়ভাবে বাংলায় রূপান্তর হবে",
            english: "ইংরেজিতে টাইপ করুন...",
        };

        input.placeholder = placeholders[currentMethod] || "";
    }

    handleInput(input) {
        const method = input.getAttribute("data-input-method");

        if (method === "avro" || method === "unijoy") {
            // Get cursor position
            const cursorPos = input.selectionStart;
            const currentValue = input.value;

            // Convert to Bangla
            const convertedValue = this.convertToBangla(currentValue, method);

            // Only update if conversion changed something
            if (convertedValue !== currentValue) {
                input.value = convertedValue;
                // Restore cursor position
                input.setSelectionRange(cursorPos, cursorPos);
            }

            // Visual feedback
            this.updateVisualFeedback(input, method);
        } else {
            this.updateVisualFeedback(input, "english");
        }
    }

    convertToBangla(text, method) {
        if (method === "english") return text;

        let result = text;

        // Convert common words first (longest matches first)
        const sortedWords = Object.entries(this.avroMapping)
            .filter(([eng, bang]) => eng.length > 1)
            .sort((a, b) => b[0].length - a[0].length);

        for (let [eng, bang] of sortedWords) {
            const regex = new RegExp("\\b" + eng + "\\b", "gi");
            result = result.replace(regex, bang);
        }

        // Handle Avro phonetic rules for remaining text
        if (method === "avro" || method === "unijoy") {
            // Convert vowel combinations first
            result = result.replace(/aa/g, "আ");
            result = result.replace(/ii/g, "ঈ");
            result = result.replace(/uu/g, "ঊ");
            result = result.replace(/ee/g, "ঈ");
            result = result.replace(/oo/g, "ঊ");
            result = result.replace(/ou/g, "ঔ");
            result = result.replace(/ai/g, "ঐ");
            result = result.replace(/au/g, "ঔ");

            // Convert consonant combinations
            result = result.replace(/kh/g, "খ");
            result = result.replace(/gh/g, "ঘ");
            result = result.replace(/ng/g, "ঙ");
            result = result.replace(/ch/g, "ছ");
            result = result.replace(/jh/g, "ঝ");
            result = result.replace(/ny/g, "ঞ");
            result = result.replace(/th/g, "ঠ");
            result = result.replace(/dh/g, "ঢ");
            result = result.replace(/ph/g, "ফ");
            result = result.replace(/bh/g, "ভ");
            result = result.replace(/sh/g, "শ");
            result = result.replace(/rh/g, "ঢ়");

            // Convert individual characters (vowels first)
            result = result.replace(/a/g, "আ");
            result = result.replace(/i/g, "ই");
            result = result.replace(/u/g, "উ");
            result = result.replace(/e/g, "এ");
            result = result.replace(/o/g, "ও");

            // Convert consonants
            result = result.replace(/k/g, "ক");
            result = result.replace(/g/g, "গ");
            result = result.replace(/c/g, "চ");
            result = result.replace(/j/g, "জ");
            result = result.replace(/t/g, "ট");
            result = result.replace(/d/g, "ড");
            result = result.replace(/n/g, "ন");
            result = result.replace(/p/g, "প");
            result = result.replace(/b/g, "ব");
            result = result.replace(/m/g, "ম");
            result = result.replace(/y/g, "য");
            result = result.replace(/r/g, "র");
            result = result.replace(/l/g, "ল");
            result = result.replace(/w/g, "ও");
            result = result.replace(/s/g, "স");
            result = result.replace(/h/g, "হ");
            result = result.replace(/z/g, "জ");
        }

        return result;
    }

    updateVisualFeedback(input, method) {
        if (method === "avro") {
            input.style.borderLeftColor = "#10B981";
            input.style.backgroundColor = "#f0fdf4";
        } else if (method === "unijoy") {
            input.style.borderLeftColor = "#3B82F6";
            input.style.backgroundColor = "#eff6ff";
        } else {
            input.style.borderLeftColor = "#6B7280";
            input.style.backgroundColor = "#f9fafb";
        }
    }

    // Public method to add keyboard switcher to new elements
    addKeyboardSwitcher(container, inputFields) {
        const switcher = container.querySelector(".keyboard-switcher");
        if (switcher) {
            this.initializeSwitchers();
        }

        if (inputFields) {
            inputFields.forEach((input) => {
                input.classList.add("bangla-input");
                input.addEventListener("input", (e) =>
                    this.handleInput(e.target)
                );
                input.addEventListener("focus", (e) =>
                    this.updatePlaceholder(e.target)
                );
            });
        }
    }
}

// Initialize when DOM is loaded
document.addEventListener("DOMContentLoaded", function () {
    window.banglaKeyboard = new BanglaKeyboardSwitcher();
});

// Export for module usage
if (typeof module !== "undefined" && module.exports) {
    module.exports = BanglaKeyboardSwitcher;
}
