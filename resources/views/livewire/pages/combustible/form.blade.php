<div class="flex flex-col w-full space-y-5">

    {{-- INFORMACION COMBUSTIBLE --}}
    <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-gas-pump text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Registro de Combustible
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <x-frk.components.label-input
                label="No. Combustible"
                error="no_combustible"
                :disabled="$disabled"
                wire:model.live="no_combustible" />

            <x-frk.components.date-picker
                label="Fecha Combustible"
                error="fecha_combustible"
                :disabled="$disabled"
                wire:model.live="fecha_combustible" />

            <x-frk.components.label-input-money
                label="Total Combustible"
                error="total_combustible"
                :disabled="$disabled"
                wire:model.live="total_combustible" />

        </div>

    </div>

    {{-- ASIGNACION --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-2">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-users text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Asignación
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <x-frk.components.select
                label="Usuario"
                :disabled="$disabled"
                error="user_id"
                wire:model.live="user_id">

                @foreach ($this->users as $data)

                    <option
                        value="{{ $data->id }}"
                        wire:key="user-{{ $data->id }}">

                        {{ $data->nombres }} {{ $data->apellidos }}

                    </option>

                @endforeach

            </x-frk.components.select>

            <x-frk.components.select
                label="Vehículo"
                :disabled="$disabled"
                error="vehiculo_id"
                wire:model.live="vehiculo_id">

                @foreach ($this->vehiculos as $data)

                    <option
                        value="{{ $data->id }}"
                        wire:key="vehiculo-{{ $data->id }}">

                        {{ $data->numero_placa }}
                        -
                        {{ $data->alias }}

                    </option>

                @endforeach

            </x-frk.components.select>

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

        <x-frk.components.label-input
            label="Observaciones"
            wire:model="observaciones" />

    </div>

    {{-- RESUMEN --}}
    <div class="bg-orange-400 rounded-2xl shadow-lg p-2 text-white">

        <div class="flex justify-between items-center">

            <span class="text-lg">
                Total Combustible
            </span>

            <span class="text-3xl font-bold">
                Q {{ number_format((float)$total_combustible, 2) }}
            </span>

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
