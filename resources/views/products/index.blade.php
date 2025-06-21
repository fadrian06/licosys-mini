<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Productos') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div
          class="p-6 text-gray-900"
          x-data='{
            bcvTax: undefined,
            products: @json($products),
            productName: "",
            get filteredProducts() {
              if (!this.productName) {
                return this.products;
              }

              return this.products.filter(product => product.name.toLowerCase().includes(this.productName.toLowerCase()));
            },
            currentBcvTax: undefined,
            currentDate: "",
            revenue: 30,

            get revenueFactor() {
              return (this.revenue / 100) + 1;
            },
          }'
          x-init="
            bcvTax = Number(localStorage.getItem('bcvTax')) || undefined;
            revenue = Number(localStorage.getItem('revenue')) || 30;

            axios.get('https://pydolarve.org/api/v2/tipo-cambio')
              .then(response => {
                currentDate = response.data.datetime.date;
                currentBcvTax = Number(response.data.monitors.usd.price);
                bcvTax ||= currentBcvTax;
              })
          "
          x-effect="
            localStorage.setItem('bcvTax', bcvTax);
            localStorage.setItem('revenue', revenue);
          ">
          <div class="flex justify-between mb-4">
            <h1 class="text-2xl font-bold">Lista de Productos</h1>
            <a href="{{ route('products.create') }}"
              class="bg-blue-500 px-4 py-2 rounded hover:bg-blue-600">
              Crear Producto
            </a>
          </div>

          <div class="mb-4">
            <dl>
              <dt class="text-sm font-medium text-gray-700">
                Valor actual de la tasa BCV:
              </dt>
              <dd
                class="text-sm text-gray-900"
                x-text="`${currentBcvTax ? currentBcvTax.toFixed(2) : 'No definido'} (${currentDate})`">
              </dd>
            </dl>

            <x-input-label for="bcvTax" :value="__('Tasa BCV')" />
            <x-text-input
              id="bcvTax"
              class="block mt-1 w-full"
              type="number"
              x-model="bcvTax"
              step=".01" />
            <x-input-label for="revenue" :value="__('Ganancia (%)')" />
            <x-text-input
              id="revenue"
              class="block mt-1 w-full"
              type="number"
              x-model="revenue"
              min="0"
              max="100" />
          </div>

          @if($products->isEmpty())
          <p>No hay productos disponibles.</p>
          @else
          <div class="mb-4">
            <x-input-label for="productName" :value="__('Buscar Producto')" />
            <x-text-input
              id="productName"
              class="block mt-1 w-full"
              type="search"
              x-model="productName"
              placeholder="Buscar por nombre..." />
          </div>

          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Nombre
                </th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  $
                </th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  BCV + Ganancia
                </th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Acciones
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <template x-for="product in filteredProducts" :key="product.id">
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap" x-text="product.name">
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap"
                    x-text="product.unit_price"></td>
                  <td
                    class="px-6 py-4 whitespace-nowrap"
                    x-text="(product.unit_price * (bcvTax || 0) * revenueFactor).toFixed(2)">
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <a :href="'/products/' + product.id + '/edit'"
                      class="text-blue-600 hover:text-blue-900">Editar</a>
                    |
                    <form :action="'/products/' + product.id" method="POST"
                      style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit"
                        class="text-red-600 hover:text-red-900">Eliminar</button>
                    </form>
                  </td>
                </tr>
              </template>
            </tbody>
          </table>
          @endif
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
