<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-white">
            Editar categoría
            <span class="text-gray-400 font-normal">
                — {{ $category->name }}
            </span>
        </h1>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white/5 backdrop-blur rounded-xl p-6 space-y-6">
                <form method="POST" action="{{ route('categories.update', $category) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="name" value="Nombre" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                            value="{{ old('name', $category->name) }}" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="flex justify-end gap-3 pt-6">
                        <a href="{{ route('products.index') }}"
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
