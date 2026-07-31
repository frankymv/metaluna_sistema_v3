<div class="flex flex-col w-full space-y-5">

    {{-- INFORMACION DEL SERVICIO --}}
    <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

        <div class="flex items-center gap-2 mb-4">

            <i class="fa-solid fa-screwdriver-wrench text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Información del Servicio
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <x-frk.components.label-input
                label="No. Servicio"
                error="no_servicio"
                :disabled="$disabled"
                wire:model="no_servicio" />

            <x-frk.components.date-picker
                :disabled="$disabledInput"
                error="fecha_servicio"
                wire:model="fecha_servicio"
                label="Fecha Servicio" />

            <x-frk.components.input-money
                label="Costo del Servicio"
                error="total_servicio"
                wire:model="total_servicio" />

        </div>

    </div>

    {{-- VEHICULO --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">

        <div class="flex items-center gap-2 mb-4">

            <i class="fa-solid fa-truck text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Vehículo Asociado
            </h3>

        </div>

        <x-frk.components.select
            label="Vehículo"
            error="vehiculo_id"
            wire:model="vehiculo_id"
            id="vehiculo_id">

            @foreach ($this->vehiculos as $data)

                <option
                    value="{{ $data->id }}"
                    wire:key="vehiculo-{{ $data->id }}">

                    {{ $data->codigo }}
                    /
                    {{ $data->numero_placa }}
                    /
                    {{ $data->alias }}

                </option>

            @endforeach

        </x-frk.components.select>

    </div>

    {{-- DETALLE --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">

        <div class="flex items-center gap-2 mb-4">

            <i class="fa-solid fa-file-lines text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Detalle del Servicio
            </h3>

        </div>

        <div class="space-y-4">

            <x-frk.components.text-area
                label="Descripción del Servicio"
                error="descripcion"
                :disabled="$disabled"
                wire:model="descripcion" />

            <x-frk.components.label-input
                label="Observaciones"
                :disabled="$disabled"
                wire:model="observaciones" />

        </div>

    </div>

    {{-- RESUMEN --}}
    <div class="bg-orange-400 rounded-2xl shadow-lg p-5 text-white">

        <div class="flex justify-between items-center">

            <span class="text-lg">
                Total Servicio
            </span>

            <span class="text-3xl font-bold">
                Q {{ number_format((float)$total_servicio, 2) }}
            </span>

        </div>

    </div>

</div>
