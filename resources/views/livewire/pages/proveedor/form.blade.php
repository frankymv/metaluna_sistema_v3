<div class="flex flex-col w-full space-y-5">

    {{-- INFORMACION GENERAL --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">

        <div class="flex items-center gap-2 mb-4">

            <i class="fa-solid fa-truck-field text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Información General
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-4">

            <div class="md:col-span-2">

                <x-frk.components.label-input
                    label="NIT"
                    :disabled="$disabled"
                    wire:model="nit" />

            </div>

            <div class="md:col-span-4">

                <x-frk.components.label-input
                    label="Nombre"
                    :disabled="$disabled"
                    wire:model="nombre" />

            </div>

            <div class="md:col-span-6">

                <x-frk.components.label-input
                    label="Descripción"
                    :disabled="$disabled"
                    wire:model="descripcion" />

            </div>

        </div>

    </div>

    {{-- CONTACTO --}}
    <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

        <div class="flex items-center gap-2 mb-4">

            <i class="fa-solid fa-address-book text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Información de Contacto
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <div class="md:col-span-2">

                <x-frk.components.label-input
                    label="Representante"
                    error="nombre_representante"
                    :disabled="$disabled"
                    wire:model="nombre_representante" />

            </div>

            <x-frk.components.label-input
                label="Teléfono Principal"
                error="telefono_principal"
                :disabled="$disabled"
                wire:model="telefono_principal" />

            <x-frk.components.label-input
                label="Teléfono Secundario"
                :disabled="$disabled"
                wire:model="telefono_secundario" />

        </div>

        <div class="mt-4">

            <x-frk.components.label-input
                label="Correo Electrónico"
                :disabled="$disabled"
                wire:model="correo_electronico" />

        </div>

    </div>

    {{-- DIRECCION --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">

        <div class="flex items-center gap-2 mb-4">

            <i class="fa-solid fa-location-dot text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Dirección
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-4">

            <div class="md:col-span-6">

                <x-frk.components.label-input
                    label="Dirección"
                    error="direccion_fisica"
                    :disabled="$disabled"
                    wire:model="direccion_fisica" />

            </div>

            <div class="md:col-span-3">

                <x-frk.components.select
                    label="Departamento"
                    error="direccion_departamento"
                    :disabled="$disabled"
                    wire:model="direccion_departamento">

                    @foreach ($this->departamentos as $data)

                        <option
                            value="{{ $data['id'] }}"
                            wire:key="departamento-{{ $data['id'] }}">

                            {{ $data['nombre'] }}

                        </option>

                    @endforeach

                </x-frk.components.select>

            </div>

            <div class="md:col-span-3">

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

            </div>

        </div>

    </div>

    {{-- ESTADO --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">

        <div class="flex items-center gap-2 mb-4">

            <i class="fa-solid fa-toggle-on text-orange-500"></i>

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
</div>
