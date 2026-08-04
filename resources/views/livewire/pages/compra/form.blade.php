<div class="flex flex-col w-full space-y-5">

    {{-- INFORMACION GENERAL --}}
    <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-cart-flatbed text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Información de la Compra
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <x-frk.components.label-input
                label="Compra No."
                error="compra_no"
                :disabled="$disabled"
                wire:model="compra_no" />

            <x-frk.components.label-input
                label="No. Recibo Compra"
                error="no_recibo_compra"
                :disabled="$disabled"
                wire:model="no_recibo_compra" />

            <x-frk.components.date-picker
                wire:model="compra_fecha"
                error="compra_fecha"
                label="Fecha de Compra" />

        </div>

    </div>

    {{-- PROVEEDOR Y SUCURSAL --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-2">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-building text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Proveedor y Destino
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <x-frk.components.select
                label="Proveedor"
                error="proveedor_id"
                :disabled="$disabled"
                wire:model="proveedor_id">

                @foreach ($this->proveedores as $data)

                    <option
                        value="{{ $data->id }}"
                        wire:key="proveedor-{{ $data->id }}">

                        {{ $data->nombre }}

                    </option>

                @endforeach

            </x-frk.components.select>

            <x-frk.components.select
                label="Sucursal"
                error="sucursal_id"
                :disabled="$disabled"
                wire:model="sucursal_id">

                @foreach ($this->sucursals as $data)

                    <option
                        value="{{ $data->id }}"
                        wire:key="sucursal-{{ $data->id }}">

                        {{ $data->nombre }}

                    </option>

                @endforeach

            </x-frk.components.select>

        </div>

    </div>

    @if (!$isShow)

        {{-- AGREGAR PRODUCTOS --}}
        <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

            <div class="flex items-center gap-2 mb-1">

                <i class="fa-solid fa-box text-orange-500"></i>

                <h3 class="font-semibold text-gray-700">
                    Agregar Productos
                </h3>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">

                <div class="lg:col-span-8">

                    <x-frk.components.select
                        label="Producto"
                        error="producto_id"
                        :disabled="$disabled"
                        wire:model="producto_id">

                        @foreach ($this->productos as $data)

                            <option
                                value="{{ $data->id }}"
                                wire:key="producto-{{ $data->id }}">

                                {{ $data->nombre }}

                            </option>

                        @endforeach

                    </x-frk.components.select>

                </div>

                <div class="lg:col-span-2">

                    <x-frk.components.label-input
                        label="Cantidad"
                        :disabled="$disabled"
                        wire:model="cantidad" />

                </div>

                <div class="lg:col-span-2 flex items-end">

                    <x-frk.components.button
                        color="blue"
                        label="Agregar"
                        wire:click.prevent="addDetalle()" />

                </div>

            </div>

        </div>

    @endif

    {{-- DETALLE COMPRA --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

        <div class="px-5 py-3 bg-orange-400 text-white">

            <div class="flex items-center justify-between">

                <h3 class="font-semibold">
                    Detalle de Compra
                </h3>

                <span class="bg-white/20 px-3 py-1 rounded-lg text-sm">
                    {{ count($inputs ?? []) }} productos
                </span>

            </div>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-orange-100">

                    <tr>

                        <th class="px-4 py-3 text-left font-semibold text-gray-700">
                            Producto
                        </th>

                        <th class="px-4 py-3 text-center font-semibold text-gray-700">
                            Cantidad
                        </th>

                        <th class="px-4 py-3 text-center font-semibold text-gray-700">
                            Acción
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100">

                    @if ($inputs != null)

                        @foreach($inputs as $key => $value)

                            <tr class="hover:bg-orange-50">

                                <td class="px-4 py-3">

                                    {{ $nombresDetalle[$value] }}

                                </td>

                                <td class="px-4 py-3 text-center">

                                    {{ $cantidadesDetalle[$value] }}

                                </td>

                                <td class="px-4 py-3 text-center">

                                    @if (!$isShow)

                                        <x-frk.components.button
                                            label="-"
                                            color="red"
                                            wire:click.prevent="removeDetalle({{ $key }})" />

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                    @else

                        <tr>

                            <td
                                colspan="3"
                                class="text-center py-10 text-gray-500">

                                <i class="fa-solid fa-box-open text-4xl text-gray-300 mb-3"></i>

                                <p>
                                    Sin productos agregados
                                </p>

                            </td>

                        </tr>

                    @endif

                </tbody>

            </table>

        </div>

    </div>

    {{-- AUDITORIA --}}
    @if ($isShow)

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-2">

            <div class="flex items-center gap-2 mb-1">

                <i class="fa-solid fa-clock text-orange-500"></i>

                <h3 class="font-semibold text-gray-700">
                    Auditoría
                </h3>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <x-frk.components.label-input
                    label="Fecha Creación"
                    :disabled="$disabled"
                    wire:model="created_at" />

                <x-frk.components.label-input
                    label="Fecha Modificación"
                    :disabled="$disabled"
                    wire:model="updated_at" />

            </div>

        </div>

    @endif

</div>
