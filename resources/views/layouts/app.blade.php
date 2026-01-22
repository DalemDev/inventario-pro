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

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 10000)" x-show="show" x-transition
                class="fixed bottom-6 right-6 z-50">
                <div
                    class="flex items-start gap-3 bg-emerald-600 text-white
                    px-4 py-3 rounded-xl shadow-lg max-w-sm">

                    <div class="mt-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>

                    <div class="text-sm leading-snug">
                        {{ session('success') }}
                    </div>

                    <button @click="show = false" class="ml-auto text-white/70 hover:text-white">
                        ✕
                    </button>
                </div>
            </div>
        @endif

        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
