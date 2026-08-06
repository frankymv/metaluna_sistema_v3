<x-frk.components.template-crud maxWidth="4xl">

    <x-slot:title>

        <div class="flex items-center gap-3">

            <div class="w-10 h-10 rounded-xl bg-orange-100 flex items-center justify-center">
                <i class="fa-solid fa-box text-orange-500"></i>
            </div>

            <div>
                <h2 class="text-xl font-bold text-gray-800">
                    Buscar Producto
                </h2>

                <p class="text-sm text-gray-500">
                    Busque y agregue productos a la venta
                </p>
            </div>

        </div>

    </x-slot:title>

    <x-slot:body>
        {{-- FILTROS --}}
<div class="flex flex-col w-full bg-orange-50 border border-orange-100 rounded-2xl p-5 mb-5">

    {{-- BUSCADOR --}}
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-4 w-full">

        <div class="lg:col-span-4">

            <x-frk.components.label-input
                label="Buscar producto"
                :disabled="$disabled"
                wire:model.live="buscar_producto" />

        </div>

        <div class="flex items-end">

            <x-frk.components.button
                label="Cancelar"
                color="red"
                wire:click="cancelarBuscarProducto()" />

        </div>

    </div>

    {{-- FILTROS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4 w-full">

        <x-frk.components.select
            label="Tipo"
            :disabled="$disabled"
            wire:model.live="id_tipo">

            @foreach ($this->tipos as $data)

                <option
                    value="{{ $data->id }}"
                    wire:key="tipo-{{ $data->id }}">

                    {{ $data->nombre }}

                </option>

            @endforeach

        </x-frk.components.select>

        <x-frk.components.select
            label="Marca"
            :disabled="$disabled"
            wire:model.live="id_marca">

            @foreach ($this->marcas as $data)

                <option
                    value="{{ $data->id }}"
                    wire:key="marca-{{ $data->id }}">

                    {{ $data->nombre }}

                </option>

            @endforeach

        </x-frk.components.select>

        <x-frk.components.select
            label="Material"
            :disabled="$disabled"
            wire:model.live="id_material">

            @foreach ($this->materiales as $data)

                <option
                    value="{{ $data->id }}"
                    wire:key="material-{{ $data->id }}">

                    {{ $data->nombre }}

                </option>

            @endforeach

        </x-frk.components.select>

    </div>

</div>

        {{-- TABLA PRODUCTOS --}}
<div class="flex flex-col w-full bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2 px-5 py-3 bg-orange-400 text-white">

        <h3 class="font-semibold">
            Productos Disponibles
        </h3>

        @if($productos)
            <span class="bg-white/20 px-3 py-1 rounded-lg text-sm w-fit">
                {{ count($productos) }} registros
            </span>
        @endif

    </div>

    <div class="w-full overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="bg-orange-100">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">
                        Código
                    </th>

                    <th class="px-4 py-3 text-left font-semibold text-gray-700">
                        Producto
                    </th>

                    <th class="px-4 py-3 text-center font-semibold text-gray-700">
                        Existencia
                    </th>

                    <th class="px-4 py-3 text-center font-semibold text-gray-700">
                        Acción
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">

                @if ($productos && count($productos))

                    @foreach($productos as $value)

                        <tr class="hover:bg-orange-50 transition-all duration-200">

                            <td class="px-4 py-4 align-top">
                                <p class="font-semibold text-gray-800">
                                    {{ $value->codigo }}
                                </p>
                            </td>

                            <td class="px-4 py-4">

                                <div class="space-y-1">

                                    <p class="text-xs font-semibold text-orange-500 uppercase tracking-wide">
                                        {{ $value->nombre_venta }}
                                    </p>

                                    <p class="text-gray-800">
                                        {{ $value->nombre }}
                                    </p>

                                </div>

                            </td>

                            <td class="px-4 py-4 text-center">

                                @if($value->existencia > 20)

                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                        {{ $value->existencia }}
                                    </span>

                                @elseif($value->existencia > 0)

                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">
                                        {{ $value->existencia }}
                                    </span>

                                @else

                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                        Sin stock
                                    </span>

                                @endif

                            </td>

                            <td class="px-4 py-4 text-center">

                                @if(collect($productosDetalle)->contains('id', $value->id))

                                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-500 text-xs font-medium">
                                        Ya agregado
                                    </span>

                                @else

                                    <button
                                        wire:click="agregarCantidadProducto({{ $value->id }})"
                                        class="inline-flex items-center gap-2 bg-orange-400 hover:bg-orange-500 text-white px-4 py-2 rounded-xl shadow-sm transition-all">

                                        <i class="fa-solid fa-plus"></i>

                                        <span>
                                            Agregar
                                        </span>

                                    </button>

                                @endif

                            </td>

                        </tr>

                    @endforeach

                @else

                    <tr>

                        <td colspan="4">

                            <div class="flex flex-col items-center justify-center py-12">

                                <i class="fa-solid fa-box-open text-5xl text-gray-300"></i>

                                <p class="mt-4 text-gray-500">
                                    No se encontraron productos
                                </p>

                                <p class="text-xs text-gray-400 mt-1">
                                    Utilice los filtros para realizar una búsqueda
                                </p>

                            </div>

                        </td>

                    </tr>

                @endif

            </tbody>

        </table>

    </div>

</div>

    </x-slot:body>

    <x-slot:footer>
    </x-slot:footer>

</x-frk.components.template-crud>
