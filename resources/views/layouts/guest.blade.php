<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/keyboard-switcher.js'])

    <!-- Bangla Font Support -->
    <style>
        body {
            font-family: 'Kalpurush', 'SolaimanLipi', 'Bangla', 'Noto Sans Bengali', sans-serif;
        }

        .bangla-text {
            font-family: 'Kalpurush', 'SolaimanLipi', 'Bangla', 'Noto Sans Bengali', sans-serif;
            direction: ltr;
            unicode-bidi: bidi-override;
        }

        .english-text {
            font-family: 'Arial', 'Helvetica', sans-serif;
        }

        /* Keyboard Switcher Styles */
        .keyboard-avro,
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
    </style>
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
