<div class="flex flex-col w-full space-y-5">

    {{-- INFORMACION ENVIO --}}
    <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-truck-fast text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Información del Envío
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <x-frk.components.label-input
                label="No Envío"
                error="envio_no"
                :disabled="$disabled_envio_no"
                wire:model="envio_no" />

            <x-frk.components.date-picker
                wire:model="envio_fecha"
                error="envio_fecha"
                label="Fecha Envío" />

            <x-frk.components.select
                label="Ruta"
                error="ruta_id"
                :disabled="$disabled"
                wire:model="ruta_id">

                @foreach ($this->rutas as $data)

                    <option
                        value="{{ $data->id }}"
                        wire:key="ruta-{{ $data->id }}">

                        {{ $data->nombre }}

                    </option>

                @endforeach

            </x-frk.components.select>

        </div>

    </div>

    {{-- ASIGNACIONES --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">

        {{-- VENTAS --}}
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

            <div class="bg-orange-400 text-white px-5 py-3">

                <h3 class="font-semibold">
                    Ventas Asignadas
                </h3>

            </div>

            <div class="p-4">

                <div class="flex gap-2 mb-4">

                    <div class="flex-1">

                        <x-frk.components.select
                            label="Ventas"
                            error="venta_id"
                            :disabled="$disabled"
                            wire:model="venta_id">

                            @foreach ($this->ventas as $data)

                                <option
                                    value="{{ $data->id }}"
                                    wire:key="venta-{{ $data->id }}">

                                    No. {{ $data->no_venta }}
                                    - {{ $data->cliente->nombres_cliente }}

                                </option>

                            @endforeach

                        </x-frk.components.select>

                    </div>

                    <div class="flex items-end">

                        <x-frk.components.button-icon
                            icon="fa-solid fa-plus"
                            wire:click.prevent="addDetalleVenta()" />

                    </div>

                </div>

                <div class="space-y-2 max-h-72 overflow-auto">

                    @foreach($inputsVenta as $value)

                        <div class="border rounded-xl p-3">

                            <div class="flex justify-between items-start">

                                <div>

                                    <p class="font-medium">
                                        Venta #{{ $noVenta[$value] }}
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        {{ $nombreCliente[$value] }}
                                    </p>

                                    <p class="text-sm text-orange-500">
                                        Q {{ $totalVenta[$value] }}
                                    </p>

                                </div>

                                <x-frk.components.button
                                    label="-"
                                    color="red"
                                    wire:click.prevent="removeDetalleVenta({{ $value }})" />

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

        {{-- USUARIOS --}}
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

            <div class="bg-orange-400 text-white px-5 py-3">

                <h3 class="font-semibold">
                    Personal Asignado
                </h3>

            </div>

            <div class="p-4">

                <div class="flex gap-2 mb-4">

                    <div class="flex-1">

                        <x-frk.components.select
                            label="Usuario"
                            error="user_id"
                            :disabled="$disabled"
                            wire:model="user_id">

                            @foreach ($this->usuarios as $data)

                                <option
                                    value="{{ $data->id }}"
                                    wire:key="usuario-{{ $data->id }}">

                                    {{ $data->nombres }}

                                </option>

                            @endforeach

                        </x-frk.components.select>

                    </div>

                    <div class="flex items-end">

                        <x-frk.components.button-icon
                            icon="fa-solid fa-plus"
                            wire:click.prevent="addDetalleUsuario()" />

                    </div>

                </div>

                <div class="space-y-2 max-h-72 overflow-auto">

                    @foreach($inputsUsuario as $value)

                        <div class="border rounded-xl p-3">

                            <div class="flex justify-between items-center">

                                <span>
                                    {{ $usuarioDetalle[$value] }}
                                </span>

                                <x-frk.components.button
                                    label="-"
                                    color="red"
                                    wire:click.prevent="removeDetalleUsuario({{ $value }})" />

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

        {{-- VEHICULOS --}}
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

            <div class="bg-orange-400 text-white px-5 py-3">

                <h3 class="font-semibold">
                    Vehículos Asignados
                </h3>

            </div>

            <div class="p-4">

                <div class="flex gap-2 mb-4">

                    <div class="flex-1">

                        <x-frk.components.select
                            label="Vehículo"
                            error="vehiculo_id"
                            :disabled="$disabled"
                            wire:model="vehiculo_id">

                            @foreach ($this->vehiculos as $data)

                                <option
                                    value="{{ $data->id }}"
                                    wire:key="vehiculo-{{ $data->id }}">

                                    {{ $data->alias }}

                                </option>

                            @endforeach

                        </x-frk.components.select>

                    </div>

                    <div class="flex items-end">

                        <x-frk.components.button-icon
                            icon="fa-solid fa-plus"
                            wire:click.prevent="addDetalleVehiculo()" />

                    </div>

                </div>

                <div class="space-y-2 max-h-72 overflow-auto">

                    @foreach($inputsVehiculo as $value)

                        <div class="border rounded-xl p-3">

                            <div class="flex justify-between items-start">

                                <div>

                                    <p>
                                        {{ $codigoVehiculo[$value] }}
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        {{ $aliasVehiculo[$value] }}
                                    </p>

                                </div>

                                <x-frk.components.button
                                    label="-"
                                    color="red"
                                    wire:click.prevent="removeDetalleVehiculo({{ $value }})" />

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    </div>

    {{-- OBSERVACIONES --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-2">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-comment text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Observaciones
            </h3>

        </div>

        <x-frk.components.text-area
            label="Observación"
            :disabled="$disabled_observaciones_inicio_envio"
            wire:model="observaciones_inicio_envio" />

    </div>

</div>
