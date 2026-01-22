<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white/5 backdrop-blur rounded-xl p-4">
                    <p class="text-sm text-gray-400">Productos</p>
                    <p class="text-2xl font-semibold text-white">{{ $totalProducts }}</p>
                </div>

                <div class="bg-white/5 backdrop-blur rounded-xl p-4">
                    <p class="text-sm text-gray-400">Bajo stock</p>
                    <p class="text-2xl font-semibold text-red-400">{{ $lowStockProducts }}</p>
                </div>
            </div>
            @if ($alerts->count())
                <div class="mt-8 space-y-4">
                    <h3 class="text-lg font-semibold text-white">
                        Alertas activas
                    </h3>

                    @foreach ($alerts->groupBy('type') as $type => $group)
                        <div class="rounded-xl border border-white/10 bg-white/5 p-4 space-y-3">

                            <h4 class="text-sm font-medium text-gray-300 uppercase tracking-wide">
                                {{ $type }}
                            </h4>

                            <ul class="space-y-2">
                                @foreach ($group as $alert)
                                    @php
                                        $styles = match ($alert->level) {
                                            'info' => 'bg-blue-500/10 border-blue-500/20 text-blue-300',
                                            'warning' => 'bg-amber-500/10 border-amber-500/20 text-amber-300',
                                            'error' => 'bg-red-500/10 border-red-500/20 text-red-300',
                                            'critical' => 'bg-red-600/20 border-red-600/30 text-red-200',
                                            default => 'bg-white/5 border-white/10 text-gray-300',
                                        };
                                    @endphp

                                    <li class="flex items-start gap-3 p-3 rounded-lg border {{ $styles }}">

                                        <div class="mt-0.5">
                                            @if ($alert->level === 'info')
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M13 16h-1v-4h-1m1-4h.01M12 18h.01" />
                                                </svg>
                                            @elseif ($alert->level === 'warning')
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 9v2m0 4h.01M10.29 3.86l-8.6 14.92A1 1 0 002.58 21h18.84a1 1 0 00.87-2.22L13.71 3.86a1 1 0 00-1.42 0z" />
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 8v4m0 4h.01M5.07 18h13.86" />
                                                </svg>
                                            @endif
                                        </div>

                                        <div class="flex-1">
                                            <p class="text-sm font-medium">
                                                {{ $alert->title }}
                                            </p>

                                            <p class="text-xs opacity-90">
                                                {{ $alert->message }}
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="mt-8">
                <h3 class="text-white text-lg font-semibold mb-3">
                    Acciones rápidas
                </h3>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('products.create') }}"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">
                        + Nuevo producto
                    </a>

                    <a href="{{ route('products.index') }}"
                        class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-lg transition">
                        Ver productos
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
