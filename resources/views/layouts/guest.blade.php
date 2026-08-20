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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-ink-text antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-ink-navy">
        <div class="mb-6">
            <a href="/" class="flex items-center gap-2">
                <svg width="32" height="32" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="13" cy="13" r="10" stroke="#2F8F8C" stroke-width="1.5" />
                    <circle cx="13" cy="13" r="2" fill="#EDEEE9" />
                    <circle cx="21.5" cy="13" r="2.25" fill="#E8A33D" />
                </svg>
                <span class="font-display font-bold text-2xl text-canvas tracking-tight">Orbit</span>
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-2 px-8 py-8 bg-white shadow-xl overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>

        <p class="font-mono text-[10px] text-canvas/30 mt-6 uppercase tracking-widest">
            Track. Assign. Deliver.
        </p>
    </div>
</body>

</html>