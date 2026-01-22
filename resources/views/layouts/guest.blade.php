<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md space-y-6">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />

            <div class="bg-white/5 backdrop-blur-xl border border-white/10 shadow-2xl rounded-2xl px-6 py-8">
                {{ $slot }}
            </div>

        </div>
    </div>
</body>

</html>
