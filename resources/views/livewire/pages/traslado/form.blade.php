<div class="flex flex-col w-full space-y-5">

    {{-- INFORMACION GENERAL --}}
    <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

        <div class="flex items-center gap-2 mb-4">

            <i class="fa-solid fa-truck-moving text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Información del Traslado
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <x-frk.components.label-input
                label="No. Traslado"
                error="traslado_no"
                :disabled="$disabled"
                wire:model="traslado_no" />

            <x-frk.components.date-picker
                wire:model="traslado_fecha"
                error="traslado_fecha"
                label="Fecha Traslado" />

        </div>

    </div>

    {{-- SUCURSALES --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">

        <div class="flex items-center gap-2 mb-4">

            <i class="fa-solid fa-building text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Origen y Destino
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <x-frk.components.select
                label="Sucursal Origen"
                error="sucursal_origen_id"
                wire:model.live="sucursal_origen_id">

                @foreach ($this->sucursals_origen as $data)

                    <option
                        value="{{ $data->id }}"
                        wire:key="origen-{{ $data->id }}">

                        {{ $data->nombre }}

                    </option>

                @endforeach

            </x-frk.components.select>

            <x-frk.components.select
                label="Sucursal Destino"
                error="sucursal_destino"
                :disabled="$disabledSucursalDestino"
                wire:model.live="sucursal_destino_id">

                @foreach ($this->sucursals_destino as $data)

                    <option
                        value="{{ $data->id }}"
                        wire:key="destino-{{ $data->id }}">

                        {{ $data->nombre }}

                    </option>

                @endforeach

            </x-frk.components.select>

        </div>

    </div>

    @if (!$isShow)

        {{-- AGREGAR PRODUCTOS --}}
        <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

            <div class="flex items-center gap-2 mb-4">

                <i class="fa-solid fa-box text-orange-500"></i>

                <h3 class="font-semibold text-gray-700">
                    Agregar Productos
                </h3>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">

                <div class="lg:col-span-6">

                    <x-frk.components.select
                        label="Producto"
                        error="producto_id"
                        :disabled="$disabled"
                        wire:model.live="producto_id">

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
                        label="Existencia"
                        error="cantidad_existencia"
                        :disabled="$disabled_existencia"
                        wire:model="cantidad_existencia" />

                </div>

                <div class="lg:col-span-2">

                    <x-frk.components.label-input
                        label="Trasladar"
                        error="cantidad_transferir"
                        :disabled="$disabled"
                        wire:model.live="cantidad_transferir" />

                </div>

                <div class="lg:col-span-2 flex items-end">

                    <x-frk.components.button
                        color="blue"
                        label="Agregar"
                        wire:click.prevent="addDetalle()" />

                </div>

            </div>

        </div>

        {{-- DETALLE --}}
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

            <div class="px-5 py-3 bg-orange-400 text-white">

                <h3 class="font-semibold">
                    Productos a Trasladar
                </h3>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-orange-100">

                        <tr>

                            <th class="px-4 py-3 text-left">
                                Producto
                            </th>

                            <th class="px-4 py-3 text-center">
                                Cantidad
                            </th>

                            <th class="px-4 py-3 text-center">
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

                                        <x-frk.components.button
                                            label="-"
                                            color="red"
                                            wire:click.prevent="removeDetalle({{ $key }})" />

                                    </td>

                                </tr>

                            @endforeach

                        @else

                            <tr>

                                <td
                                    colspan="3"
                                    class="text-center py-10 text-gray-500">

                                    Sin productos agregados

                                </td>

                            </tr>

                        @endif

                    </tbody>

                </table>

            </div>

        </div>

    @endif

    {{-- AUDITORIA --}}
    @if ($isShow)

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">

            <div class="flex items-center gap-2 mb-4">

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
