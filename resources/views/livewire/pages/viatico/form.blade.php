<div class="flex flex-col w-full space-y-5">

    {{-- INFORMACION GENERAL --}}
    <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-wallet text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Información del Viático
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <x-frk.components.label-input
                label="No. Viático"
                error="codigo"
                disabled
                wire:model.live="no_viatico" />

            <x-frk.components.date-picker
                label="Fecha Viático"
                error="fecha_viatico"
                :disabled="$disabled"
                wire:model.live="fecha_viatico" />

            <x-frk.components.label-input-money
                label="Total Viático"
                error="total_viatico"
                :disabled="$disabled"
                wire:model.live="total_viatico" />

        </div>

    </div>

    {{-- USUARIO --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-2">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-user text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Usuario Asignado
            </h3>

        </div>

        <x-frk.components.select
            label="Usuario"
            :disabled="$disabled"
            error="user_id"
            wire:model.live="user_id"
            id="user_id">

            @foreach ($this->users as $data)

                <option
                    value="{{ $data->id }}"
                    wire:key="user-{{ $data->id }}">

                    {{ $data->nombres }}
                    {{ $data->apellidos }}

                </option>

            @endforeach

        </x-frk.components.select>

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
                Total Viático
            </span>

            <span class="text-3xl font-bold">
                Q {{ number_format((float)$total_viatico, 2) }}
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
