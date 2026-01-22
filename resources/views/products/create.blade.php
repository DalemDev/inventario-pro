<x-app-layout>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-white">
            Crear producto
        </h1>

        <p class="text-sm text-gray-400 mt-1">
            Registra un nuevo producto en tu inventario
        </p>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white/5 backdrop-blur rounded-xl p-6 space-y-6">
                <form method="POST" action="{{ route('products.store') }}">
                    @csrf

                    <div>
                        <h3 class="text-sm font-semibold text-gray-300 mb-3">
                            Información básica
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs text-gray-400">Nombre</label>
                                <input required type="text" name="name" value="{{ old('name') }}"
                                    placeholder="Ej: Laptop Dell XPS 13"
                                    class="w-full bg-white/10 text-white rounded-lg px-3 py-2">
                            </div>

                            <div>
                                <label class="text-xs text-gray-400">SKU</label>
                                <input type="text" name="sku" value="{{ old('sku') }}"
                                    placeholder="Ej: LAP-001"
                                    class="w-full bg-white/10 text-white rounded-lg px-3 py-2">
                            </div>
                        </div>
                    </div>

                    <div class="pt-4">
                        <label class="text-xs text-gray-400">Descripción</label>
                        <textarea name="description" rows="3" placeholder="Descripción del producto"
                            class="w-full bg-white/10 text-white rounded-lg px-3 py-2 resize-none">{{ old('description') }}</textarea>
                    </div>

                    <div class="pt-4">
                        <h3 class="text-sm font-semibold text-gray-300 mb-4">
                            Datos comerciales
                        </h3>

                        <div class="space-y-6">
                            <div>
                                <label class="text-xs text-gray-400 mb-1 block">
                                    Categoría
                                </label>

                                <select required name="category_id"
                                    class="w-full bg-white/10 text-white rounded-lg px-3 py-2
                                    focus:ring-2 focus:ring-indigo-500">
                                    <option class="bg-slate-800 text-white" value="">— Selecciona una categoría —
                                    </option>

                                    @foreach ($categories as $category)
                                        <option class="bg-slate-800 text-white" value="{{ $category->id }}"
                                            @selected(old('category_id') == $category->id)>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="text-xs text-gray-400 mb-2 block">
                                    Proveedores
                                </label>

                                <div class="space-y-3">
                                    @foreach ($providers as $provider)
                                        <div
                                            class="grid grid-cols-12 gap-3 items-center rounded-lg border border-white/10 px-3 py-2">

                                            <div class="col-span-1 text-center">
                                                <input type="checkbox" name="providers[{{ $provider->id }}][selected]"
                                                    value="1"
                                                    class="rounded bg-white/10 border-white/20 text-indigo-600">
                                            </div>

                                            <div class="col-span-4">
                                                <p class="text-sm text-white">
                                                    {{ $provider->name }}
                                                </p>
                                                <p class="text-xs text-gray-400">
                                                    {{ $provider->email }}
                                                </p>
                                            </div>

                                            <div class="col-span-4">
                                                <input type="number" step="0.01"
                                                    name="providers[{{ $provider->id }}][cost]" placeholder="Costo"
                                                    class="w-full bg-white/10 text-white rounded-lg px-3 py-2 text-sm">
                                            </div>

                                            <div class="col-span-3 text-center">
                                                <label class="inline-flex items-center gap-2 text-xs text-gray-400">
                                                    <input type="radio" name="default_provider"
                                                        value="{{ $provider->id }}" class="text-indigo-600">
                                                    Principal
                                                </label>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>

                                <p class="text-xs text-gray-500 mt-2">
                                    Selecciona al menos un proveedor y define su costo.
                                    Solo uno puede ser el proveedor principal.
                                </p>
                            </div>

                        </div>
                    </div>

                    <div class="pt-4">
                        <h3 class="text-sm font-semibold text-gray-300 mb-3">
                            Inventario
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="text-xs text-gray-400">Stock inicial</label>
                                <input type="number" disabled
                                    class="w-full bg-white/10 text-white rounded-lg px-3 py-2"
                                    placeholder="Se define mediante el primer movimiento">
                            </div>

                            <div>
                                <label class="text-xs text-gray-400">Stock mínimo</label>
                                <input required type="number" name="minimum_stock" value="{{ old('minimum_stock') }}"
                                    placeholder="Corresponde al valor mínimo que puede haber de este producto"
                                    class="w-full bg-white/10 text-white rounded-lg px-3 py-2">
                            </div>
                        </div>

                        <p class="text-xs text-gray-500 mt-2">
                            El stock no se asigna aquí.
                            Después de crear el producto, registra una <strong>entrada</strong> en el Kardex.
                        </p>
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
