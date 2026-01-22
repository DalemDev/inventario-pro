<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-white">
                        {{ $product->name }}
                    </h1>
                    <p class="text-sm text-gray-400">
                        Detalle del producto
                    </p>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('products.edit', $product) }}"
                        class="px-4 py-2 rounded-lg bg-white/10 hover:bg-white/20 text-white text-sm transition">
                        Editar
                    </a>

                    <a href="{{ route('products.movements.index', $product) }}"
                        class="px-4 py-2 rounded-lg bg-indigo-600 hover:bg-indigo-500 text-sm text-white transition">
                        Ver Kardex
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white/5 backdrop-blur rounded-xl border border-white/10 p-6 space-y-4">
                        <h3 class="text-sm font-semibold text-gray-300 uppercase">
                            Información general
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="text-xs text-gray-400 uppercase">SKU</p>
                                <p class="text-white">{{ $product->sku ?? '—' }}</p>
                            </div>

                            <div>
                                <p class="text-xs text-gray-400 uppercase">Categoría</p>
                                <p class="text-white">
                                    {{ $product->category?->name ?? 'Sin categoría' }}
                                </p>
                            </div>

                            <div class="sm:col-span-2">
                                <p class="text-xs text-gray-400 uppercase">Descripción</p>
                                <p class="text-gray-300">
                                    {{ $product->description ?? 'Sin descripción' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/5 backdrop-blur rounded-xl border border-white/10 p-6 space-y-4">
                        <h3 class="text-sm font-semibold text-gray-300 uppercase">
                            Proveedores
                        </h3>

                        @if ($product->providers->count())
                            <div class="space-y-3">
                                @foreach ($product->providers as $provider)
                                    <div
                                        class="flex items-center justify-between rounded-lg px-4 py-3 border
                                        {{ $provider->pivot->is_default ? 'border-indigo-500/40 bg-indigo-500/10' : 'border-white/10' }}">

                                        <div>
                                            <p class="text-sm text-white flex items-center gap-2">
                                                {{ $provider->name }}

                                                @if ($provider->pivot->is_default)
                                                    <span
                                                        class="text-xs px-2 py-0.5 rounded-full bg-indigo-500/20 text-indigo-400">
                                                        Principal
                                                    </span>
                                                @endif
                                            </p>

                                            <p class="text-xs text-gray-400">
                                                {{ $provider->email ?? '—' }}
                                            </p>
                                        </div>

                                        <div class="text-right">
                                            <p class="text-xs text-gray-400 uppercase">
                                                Costo
                                            </p>
                                            <p class="text-sm text-white font-medium">
                                                ${{ number_format($provider->pivot->cost, 2) }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-gray-400">
                                No hay proveedores asignados.
                            </p>
                        @endif
                    </div>

                </div>

                <div class="space-y-4">
                    <div class="bg-white/5 backdrop-blur rounded-xl border border-white/10 p-6 text-center space-y-2">
                        <p class="text-xs text-gray-400 uppercase">
                            Stock actual
                        </p>

                        <p
                            class="text-4xl font-semibold
                            {{ $product->current_stock <= $product->minimum_stock ? 'text-red-400' : 'text-green-400' }}">
                            {{ $product->current_stock }}
                        </p>

                        <p class="text-xs text-gray-400">
                            Mínimo: {{ $product->minimum_stock }}
                        </p>
                    </div>

                    <div class="text-center">
                        @if ($product->current_stock <= $product->minimum_stock)
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs bg-red-500/20 text-red-400">
                                Stock bajo
                            </span>
                        @else
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs bg-green-500/20 text-green-400">
                                Stock OK
                            </span>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
