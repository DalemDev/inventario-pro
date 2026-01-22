<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-white">
            Crear categoría
        </h1>

        <p class="text-sm text-gray-400 mt-1">
            Crea una categoría para organizar tus productos
        </p>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white/5 backdrop-blur rounded-xl p-6 space-y-6">
                <form method="POST" action="{{ route('categories.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="name" value="Nombre" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                            value="{{ old('name') }}" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="flex justify-end gap-3 pt-6">
                        <a href="{{ route('products.index') }}"
                            class="px-4 py-2 text-sm text-gray-300 hover:text-white">
                            Cancelar
                        </a>

                        <button type="submit"
                            class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm">
                            Crear producto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
