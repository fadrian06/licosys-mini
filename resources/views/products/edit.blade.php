<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Producto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form
                        method="POST"
                        action="{{ route('products.update', $product) }}"
                        x-data="{
                            name: '{{ $product->name }}',
                            unitPrice: {{ $product->unit_price }}
                        }"
                        x-effect="name = name.toUpperCase()">
                        @csrf
                        @method('PUT')

                        <!-- Product Name -->
                        <div class="mt-4">
                            <x-input-label for="name" :value="__('Nombre del Producto')" />
                            <x-text-input
                                id="name"
                                class="block mt-1 w-full"
                                type="text"
                                name="name"
                                :value="$product->name"
                                required
                                x-model="name"
                            />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Product Price per Unit. Calculated automatically by Alpine -->
                        <div class="mt-4">
                            <x-input-label for="unit_price" :value="__('Precio por Unidad')" />
                            <x-text-input id="unit_price" class="block mt-1 w-full" type="text" name="unit_price" x-model="unitPrice" readonly />
                            <x-input-error :messages="$errors->get('unit_price')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-3">
                                {{ __('Actualizar Producto') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
