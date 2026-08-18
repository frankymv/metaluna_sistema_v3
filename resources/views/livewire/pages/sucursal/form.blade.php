<div class="flex flex-col w-full space-y-5">

    {{-- INFORMACION GENERAL --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-2">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-building text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Información General
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-4">

            <div class="md:col-span-2">

                <x-frk.components.label-input
                    label="Código"
                    :disabled="$disabled"
                    wire:model="codigo" />

            </div>

            <div class="md:col-span-4">

                <x-frk.components.label-input
                    label="Nombre"
                    :disabled="$disabled"
                    wire:model="nombre" />

            </div>

            <div class="md:col-span-6">

                <x-frk.components.label-input
                    label="Correo Electronico"
                    :disabled="$disabled"
                    wire:model="correo_electronico" />

            </div>

        </div>
        <div class="md:col-span-6">

                <x-frk.components.label-input
                    label="Dirección Fisica"
                    :disabled="$disabled"
                    wire:model="direccion_fisica" />

            </div>

    </div>

    {{-- UBICACION Y CONTACTO --}}
    <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-location-dot text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Ubicación y Contacto
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <x-frk.components.select
                label="Departamento"
                error="direccion_departamento"
                :disabled="$disabled"
                wire:model.live="direccion_departamento">

                @foreach ($this->departamentos as $data)

                    <option
                        value="{{ $data['id'] }}"
                        wire:key="departamento-{{ $data['id'] }}">

                        {{ $data['nombre'] }}

                    </option>

                @endforeach

            </x-frk.components.select>

            <x-frk.components.select
                label="Municipio"
                error="direccion_municipio"
                :disabled="$disabled"
                wire:model="direccion_municipio">

                @foreach ($this->municipios as $data)

                    <option
                        value="{{ $data['id'] }}"
                        wire:key="municipio-{{ $data['id'] }}">

                        {{ $data['nombre'] }}

                    </option>

                @endforeach

            </x-frk.components.select>

            <x-frk.components.label-input
                label="Teléfono Principal"
                :disabled="$disabled"
                wire:model="telefono_principal" />

            <x-frk.components.label-input
                label="Teléfono Secundario"
                :disabled="$disabled"
                wire:model="telefono_secundario" />

        </div>

    </div>

    {{-- CONFIGURACION --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-2">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-sliders text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Configuración de la Sucursal
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <div class="bg-orange-50 border border-orange-100 rounded-xl p-4">

                <x-frk.components.toggle
                    :disabled="$disabled"
                    label="Bodega"
                    left="SI"
                    right="NO" />

            </div>

            <div class="bg-orange-50 border border-orange-100 rounded-xl p-4">

                <x-frk.components.toggle
                    :disabled="$disabled"
                    label="Visible"
                    left="SI"
                    right="NO" />

            </div>

            <div class="bg-orange-50 border border-orange-100 rounded-xl p-4">

                <x-frk.components.toggle
                    :disabled="$disabled"
                    label="Estado"
                    left="SI"
                    right="NO" />
            </div>
        </div>
    </div>
</div>
