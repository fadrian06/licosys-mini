<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Producto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form
                        method="POST"
                        action="{{ route('products.store') }}"
                        x-data="{
                            name: '',
                            units: undefined,
                            pricePerBox: undefined,
                            get pricePerUnit() {
                                return this.units && this.pricePerBox ? (this.pricePerBox / this.units).toFixed(2) : '';
                            },
                        }"
                        x-effect="name = name.toUpperCase()">
                        @csrf
                        <!-- Product Name -->
                        <div class="mt-4">
                            <x-input-label for="name" :value="__('Nombre del Producto')" />
                            <x-text-input
                                id="name"
                                class="block mt-1 w-full"
                                type="text"
                                name="name"
                                :value="old('name')"
                                required
                                x-model="name"
                            />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <!-- Product Units -->
                        <div class="mt-4">
                            <x-input-label for="units" :value="__('Unidades por Caja')" />
                            <x-text-input id="units" class="block mt-1 w-full" type="number" name="units" x-model="units" required />
                            <x-input-error :messages="$errors->get('units')" class="mt-2" />
                        </div>
                        <!-- Product Price per Box -->
                        <div class="mt-4">
                            <x-input-label for="price_per_box" :value="__('Precio por Caja')" />
                            <x-text-input
                                id="price_per_box"
                                class="block mt-1 w-full"
                                type="number"
                                name="price_per_box"
                                x-model="pricePerBox"
                                required
                                step=".01"
                            />
                            <x-input-error :messages="$errors->get('price_per_box')" class="mt-2" />
                        </div>
                        <!-- Product Price per Unit. Calculated automatically by Alpine -->
                        <div class="mt-4">
                            <x-input-label for="unit_price" :value="__('Precio por Unidad')" />
                            <x-text-input id="unit_price" class="block mt-1 w-full" type="text" name="unit_price" x-model="pricePerUnit" readonly />
                            <x-input-error :messages="$errors->get('unit_price')" class="mt-2" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-3">
                                {{ __('Crear Producto') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
