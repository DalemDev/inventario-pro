<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body
    class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <div
        class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <main class="flex w-full flex-col items-center text-center lg:text-left lg:flex-row gap-16">

            <div class="flex-1 space-y-8">
                <span
                    class="inline-flex items-center gap-2 px-3 py-1 text-xs rounded-full bg-indigo-500/10 text-indigo-400 border border-indigo-500/20">
                    🚀 SaaS de Inventarios
                </span>

                <h1 class="text-4xl lg:text-5xl font-semibold tracking-tight text-[#1b1b18] dark:text-[#EDEDEC]">
                    Controla tu inventario
                    <span class="block bg-gradient-to-r from-indigo-400 to-cyan-400 bg-clip-text text-transparent">
                        en tiempo real
                    </span>
                </h1>

                <p class="text-base text-gray-600 dark:text-gray-400 max-w-xl">
                    Gestiona productos, movimientos, alertas de stock y proveedores
                    desde una plataforma clara, rápida y diseñada para crecer contigo.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ route('register') }}"
                        class="px-6 py-3 rounded-xl bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-500 transition shadow-lg shadow-indigo-600/30">
                        Crear cuenta gratis
                    </a>

                    <a href="{{ route('login') }}"
                        class="px-6 py-3 rounded-xl border border-white/10 text-sm text-gray-200 hover:bg-white/10 transition">
                        Iniciar sesión
                    </a>
                </div>

                <div class="flex flex-wrap gap-6 text-xs text-gray-500 justify-center lg:justify-start">
                    <span>✔ Multi-empresa</span>
                    <span>✔ Kardex automático</span>
                    <span>✔ Alertas inteligentes</span>
                    <span>✔ Seguridad por roles</span>
                </div>
            </div>

            <div class="flex-1 hidden lg:flex justify-center relative">
                <div class="absolute -inset-6 bg-indigo-500/20 blur-3xl rounded-full"></div>

                <div
                    class="relative w-full max-w-lg rounded-2xl bg-white/60 dark:bg-white/5 backdrop-blur-xl border border-white/10 shadow-2xl p-6">

                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs text-gray-400 uppercase tracking-wider">
                            Inventario
                        </span>
                        <span class="text-xs text-green-400">
                            Stock actualizado
                        </span>
                    </div>

                    <div class="space-y-3 text-left text-sm">
                        <div
                            class="flex justify-between items-center rounded-lg bg-white/70 dark:bg-white/10 px-4 py-3">
                            <span>Laptop Dell</span>
                            <span class="text-green-400 font-medium">25</span>
                        </div>

                        <div
                            class="flex justify-between items-center rounded-lg bg-white/70 dark:bg-white/10 px-4 py-3">
                            <span>Mouse Logitech</span>
                            <span class="text-red-400 font-medium">3</span>
                        </div>

                        <div
                            class="flex justify-between items-center rounded-lg bg-white/70 dark:bg-white/10 px-4 py-3">
                            <span>Teclado Mecánico</span>
                            <span class="text-yellow-400 font-medium">10</span>
                        </div>
                    </div>
                </div>
            </div>

        </main>

    </div>

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
</body>

</html>
