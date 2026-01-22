<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-white">
            Kardex
            <span class="text-gray-400 font-normal">
                — {{ $product->name }}
            </span>
        </h1>

        <p class="text-sm text-gray-400 mt-1">
            SKU: {{ $product->sku }}
        </p>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">

                <div class="bg-white/5 backdrop-blur rounded-xl p-4">
                    <p class="text-sm text-gray-400">Stock actual</p>
                    <p class="text-3xl font-semibold text-white">
                        {{ $product->current_stock }}
                    </p>
                </div>

                <div class="bg-white/5 backdrop-blur rounded-xl p-4">
                    <p class="text-sm text-gray-400">Stock mínimo</p>
                    <p class="text-3xl font-semibold text-white">
                        {{ $product->minimum_stock }}
                    </p>
                </div>

                <div class="bg-white/5 backdrop-blur rounded-xl p-4">
                    <p class="text-sm text-gray-400">Estado</p>

                    @if ($product->current_stock <= $product->minimum_stock)
                        <span class="inline-block mt-1 px-3 py-1 text-sm rounded-full bg-red-500/20 text-red-400">
                            Bajo stock
                        </span>
                    @else
                        <span class="inline-block mt-1 px-3 py-1 text-sm rounded-full bg-green-500/20 text-green-400">
                            Stock OK
                        </span>
                    @endif
                </div>

            </div>

            <div class="bg-white/5 backdrop-blur rounded-xl p-4 mb-8">
                <h3 class="text-white font-semibold mb-4">
                    Registrar movimiento
                </h3>

                <form method="POST" action="{{ route('products.movements.store', $product) }}"
                    class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    @csrf

                    <select name="type"
                        class="bg-white/10 text-white rounded-lg px-3 py-2
           focus:ring-2 focus:ring-indigo-500">
                        <option value="entrada" class="bg-slate-800 text-white">
                            Entrada
                        </option>
                        <option value="salida" class="bg-slate-800 text-white">
                            Salida
                        </option>
                        <option value="ajuste" class="bg-slate-800 text-white">
                            Ajuste
                        </option>
                    </select>

                    <select name="provider_id"
                        class="bg-white/10 text-white rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500">

                        @foreach ($providers as $provider)
                            <option class="bg-slate-800 text-white" value="{{ $provider->id }}"
                                @selected(old('provider_id') == $provider->id)>
                                {{ $provider->name }}
                            </option>
                        @endforeach
                    </select>

                    <input type="number" name="quantity" placeholder="Cantidad"
                        class="bg-white/10 text-white rounded-lg px-3 py-2">

                    <input type="text" name="reason" placeholder="Motivo"
                        class="bg-white/10 text-white rounded-lg px-3 py-2">

                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 transition text-white rounded-lg px-4 py-2">
                        Registrar
                    </button>
                </form>
            </div>

            @if ($movements->isEmpty())
                <div class="text-center py-10 text-gray-400">
                    <p class="text-sm">
                        Este producto no tiene movimientos registrados.
                    </p>
                    <p class="text-xs mt-1">
                        Registra una <strong>entrada</strong> para definir el stock inicial.
                    </p>
                </div>
            @else
                <div class="bg-white/5 backdrop-blur rounded-xl overflow-hidden">
                    <table class="min-w-full text-sm text-gray-200">
                        <thead class="bg-white/5 text-xs uppercase text-gray-400">
                            <tr>
                                <th class="px-4 py-3 text-left">Fecha</th>
                                <th class="px-4 py-3 text-center">Tipo</th>
                                <th class="px-4 py-3 text-center">Proveedor</th>
                                <th class="px-4 py-3 text-center">Cantidad</th>
                                <th class="px-4 py-3 text-center">Antes</th>
                                <th class="px-4 py-3 text-center">Después</th>
                                <th class="px-4 py-3 text-left">Motivo</th>
                                <th class="px-4 py-3 text-left">Usuario</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach ($movements as $movement)
                                <tr class="hover:bg-white/5 transition">

                                    <td class="px-4 py-3">
                                        {{ $movement->created_at->format('d/m/Y H:i') }}
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        @if ($movement->type === 'entrada')
                                            <span class="text-green-400">Entrada</span>
                                        @elseif($movement->type === 'salida')
                                            <span class="text-red-400">Salida</span>
                                        @else
                                            <span class="text-yellow-400">Ajuste</span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-3 text-center font-medium">
                                        {{ $movement->provider->name }}
                                    </td>

                                    <td class="px-4 py-3 text-center font-medium">
                                        {{ $movement->quantity }}
                                    </td>

                                    <td class="px-4 py-3 text-center text-gray-400">
                                        {{ $movement->stock_before }}
                                    </td>

                                    <td class="px-4 py-3 text-center text-white">
                                        {{ $movement->stock_after }}
                                    </td>

                                    <td class="px-4 py-3 text-gray-300">
                                        {{ $movement->reason }}
                                    </td>

                                    <td class="px-4 py-3 text-gray-400">
                                        {{ $movement->user->name ?? 'Sistema' }}
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
