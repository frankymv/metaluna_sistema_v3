<div class="flex flex-col w-full space-y-5">

    {{-- IDENTIFICACION --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-2">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-truck text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Información del Vehículo
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <x-frk.components.label-input
                label="Código"
                :disabled="$disabled"
                wire:model="codigo" />

            <x-frk.components.select
                label="Tipo Vehículo"
                error="tipo_vehiculo_id"
                :disabled="$disabled"
                wire:model="tipo_vehiculo_id">

                @foreach ($this->tipos as $data)

                    <option
                        value="{{ $data['id'] }}"
                        wire:key="tipo-{{ $data['id'] }}">

                        {{ $data['nombre'] }}

                    </option>

                @endforeach

            </x-frk.components.select>

            <x-frk.components.select
                label="Tipo Placa"
                error="tipo_placa_id"
                :disabled="$disabled"
                wire:model="tipo_placa_id">

                @foreach ($this->placas as $data)

                    <option
                        value="{{ $data['id'] }}"
                        wire:key="placa-{{ $data['id'] }}">

                        {{ $data['nombre'] }}

                    </option>

                @endforeach

            </x-frk.components.select>

            <x-frk.components.label-input
                label="Número Placa"
                :disabled="$disabled"
                wire:model="numero_placa" />

        </div>

    </div>

    {{-- DATOS TECNICOS --}}
    <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-gear text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Datos Técnicos
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <x-frk.components.select
                label="Marca"
                error="marca_vehiculo_id"
                :disabled="$disabled"
                wire:model="marca_vehiculo_id">

                @foreach ($this->marcas as $data)

                    <option
                        value="{{ $data['id'] }}"
                        wire:key="marca-{{ $data['id'] }}">

                        {{ $data['nombre'] }}

                    </option>

                @endforeach

            </x-frk.components.select>

            <x-frk.components.select
                label="Modelo"
                error="modelo_vehiculo"
                :disabled="$disabled"
                wire:model="modelo_vehiculo_id">

                @foreach ($this->modelos as $data)

                    <option
                        value="{{ $data['id'] }}"
                        wire:key="modelo-{{ $data['id'] }}">

                        {{ $data['nombre'] }}

                    </option>

                @endforeach

            </x-frk.components.select>

            <x-frk.components.label-input
                label="Línea"
                :disabled="$disabled"
                wire:model="linea" />

            <x-frk.components.label-input
                label="Alias"
                :disabled="$disabled"
                wire:model="alias" />

        </div>

    </div>

    {{-- ESTADO --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-2">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-circle-check text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Estado del Registro
            </h3>

        </div>

        <div class="max-w-xs">

            <div class="bg-orange-50 border border-orange-100 rounded-xl p-4">

                <x-frk.components.toggle
                    :disabled="$disabled"
                    label="Estado" />

            </div>

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
