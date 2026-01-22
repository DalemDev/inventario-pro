<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <a href="{{ route('products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
                Nuevo producto
            </a>

            <div class="mt-6 bg-white/5 backdrop-blur rounded-xl overflow-hidden">
                <table class="min-w-full text-sm text-gray-200">
                    <thead class="bg-white/5 text-gray-400 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3 text-left">Nombre</th>
                            <th class="px-4 py-3 text-center">SKU</th>
                            <th class="px-4 py-3 text-center">Stock actual</th>
                            <th class="px-4 py-3 text-center">Stock mínimo</th>
                            <th class="px-4 py-3 text-center">Estado</th>
                            <th class="px-4 py-3 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach ($products as $product)
                            <tr class="hover:bg-white/5 transition">
                                <td class="px-4 py-3">{{ $product->name }}</td>
                                <td class="px-4 py-3 text-center">{{ $product->sku }}</td>
                                <td class="px-4 py-3 text-center">{{ $product->current_stock ?: 0 }}</td>
                                <td class="px-4 py-3 text-center">{{ $product->minimum_stock }}</td>
                                <td class="px-4 py-3 text-center">
                                    @if ($product->current_stock <= $product->minimum_stock)
                                        <span class="text-xs px-2 py-1 rounded bg-red-500/20 text-red-400">
                                            Bajo
                                        </span>
                                    @else
                                        <span class="text-xs px-2 py-1 rounded bg-green-500/20 text-green-400">
                                            OK
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex justify-center items-center gap-2">
                                        <a href="{{ route('products.show', $product) }}"
                                            class="p-2 rounded-lg hover:bg-white/10 transition group"
                                            title="Ver producto">

                                            <svg class="w-5 h-5 text-gray-300 group-hover:text-white" fill="none"
                                                stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">

                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5
               c4.477 0 8.268 2.943 9.542 7
               -1.274 4.057 -5.065 7 -9.542 7
               -4.477 0 -8.268 -2.943 -9.542 -7z" />

                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1 -6 0
               a3 3 0 0 1 6 0z" />
                                            </svg>
                                        </a>

                                        <a href="{{ route('products.edit', $product) }}"
                                            class="p-2 rounded-lg hover:bg-white/10 transition group"
                                            title="Editar producto">
                                            <svg class="w-5 h-5 text-gray-300 group-hover:text-white" fill="none"
                                                stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 3.487l3.651 3.651M6 18l4.5-1.125L19.5 7.875l-3.75-3.75L6.75 13.125 6 18z" />
                                            </svg>
                                        </a>

                                        <a href="{{ route('products.movements.index', $product) }}"
                                            class="p-2 rounded-lg hover:bg-white/10 transition group"
                                            title="Ver Kardex">
                                            <svg class="w-5 h-5 text-indigo-400 group-hover:text-indigo-300"
                                                fill="none" stroke="currentColor" stroke-width="1.5"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 4h18M3 10h18M3 16h18" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>
