<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-white">
            Editar proveedor
            <span class="text-gray-400 font-normal">
                — {{ $provider->name }}
            </span>
        </h1>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white/5 backdrop-blur rounded-xl p-6 space-y-6">
                <form method="POST" action="{{ route('providers.update', $provider) }}">
                    @csrf
                    @method('PUT')

                    <div>
                        <h3 class="text-sm font-semibold text-gray-300 mb-3">
                            Información básica
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs text-gray-400">Nombre</label>
                                <input type="text" name="name" value="{{ old('name', $provider->name) }}"
                                    class="w-full bg-white/10 text-white rounded-lg px-3 py-2">
                            </div>

                            <div>
                                <label class="text-xs text-gray-400">Email</label>
                                <input type="text" name="email" value="{{ old('email', $provider->email) }}"
                                    placeholder="Ej: proveedor@example.com"
                                    class="w-full bg-white/10 text-white rounded-lg px-3 py-2">
                            </div>

                            <div>
                                <label class="text-xs text-gray-400">Teléfono</label>
                                <input type="text" name="phone" value="{{ old('phone', $provider->phone) }}"
                                    placeholder="Ej: 0999999999"
                                    class="w-full bg-white/10 text-white rounded-lg px-3 py-2">
                            </div>

                            <div>
                                <label class="text-xs text-gray-400">Dirección</label>
                                <input type="text" name="address" value="{{ old('address', $provider->address) }}"
                                    placeholder="Ej: xxxxxxx"
                                    class="w-full bg-white/10 text-white rounded-lg px-3 py-2">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-6">
                        <a href="{{ route('providers.index') }}"
                            class="px-4 py-2 text-sm text-gray-300 hover:text-white">
                            Cancelar
                        </a>

                        <button type="submit"
                            class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm">
                            Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
