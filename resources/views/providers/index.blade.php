<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <a href="{{ route('providers.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
                Nuevo proveedor
            </a>

            <div class="bg-white/5 rounded-xl overflow-hidden">
                <table class="min-w-full text-sm text-gray-200">
                    <thead class="bg-white/5 text-gray-400 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3 text-left">Nombre</th>
                            <th class="px-4 py-3 text-left">Email</th>
                            <th class="px-4 py-3 text-left">Teléfono</th>
                            <th class="px-4 py-3 text-left">Dirección</th>
                            <th class="px-4 py-3 text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-white/5">
                        @foreach ($providers as $provider)
                            <tr class="hover:bg-white/5">
                                <td class="px-4 py-3 font-medium">
                                    {{ $provider->name }}
                                </td>
                                <td class="px-4 py-3 font-medium">
                                    {{ $provider->email }}
                                </td>
                                <td class="px-4 py-3 font-medium">
                                    {{ $provider->phone }}
                                </td>
                                <td class="px-4 py-3 font-medium">
                                    {{ $provider->address }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex justify-center items-center gap-2">
                                        <a href="{{ route('providers.edit', $provider) }}"
                                            class="p-2 rounded-lg hover:bg-white/10 transition group "
                                            title="Editar categoría">
                                            <svg class="w-5 h-5 text-gray-300 group-hover:text-white" fill="none"
                                                stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 3.487l3.651 3.651M6 18l4.5-1.125L19.5 7.875l-3.75-3.75L6.75 13.125 6 18z" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $providers->links() }}
        </div>
    </div>
</x-app-layout>
