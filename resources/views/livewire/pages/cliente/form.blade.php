<div class="flex flex-col w-full space-y-5">

    {{-- INFORMACION FISCAL --}}
    <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-user-tie text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Información Fiscal
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">

            <x-frk.components.select
                label="Tipo Cliente"
                :disabled="$disabled"
                error="tipo_cliente_id"
                wire:model.live="tipo_cliente_id">

                @foreach ($this->tipo_clientes as $data)

                    <option
                        value="{{ $data['valor'] }}"
                        wire:key="tipo-{{ $data['id'] }}">

                        {{ $data['nombre'] }}

                    </option>

                @endforeach

            </x-frk.components.select>

            <x-frk.components.label-input
                label="Código Interno"
                :disabled="$disabled_codigo_interno"
                wire:model.live="codigo_interno" />

            <x-frk.components.label-input
                label="NIT"
                :disabled="$disabled"
                wire:model="nit" />

            @if (!$isDisabledMinorista)

                <x-frk.components.label-input
                    label="Patente"
                    :disabled="$disabled"
                    wire:model="numero_patente" />

                <x-frk.components.label-input
                    label="Código Mayorista"
                    :disabled="$disabledCodigo"
                    wire:model="codigo_mayorista" />

            @endif

        </div>

    </div>

    {{-- DATOS PERSONALES --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-2">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-user text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Datos del Cliente
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">

            <div class="md:col-span-2">

                <x-frk.components.label-input
                    label="Nombres"
                    error="nombres_cliente"
                    :disabled="$disabled"
                    wire:model="nombres_cliente" />

            </div>

            <div class="md:col-span-2">

                <x-frk.components.label-input
                    label="Apellidos"
                    :disabled="$disabled"
                    wire:model="apellidos_cliente" />

            </div>

            <div>

                <x-frk.components.label-input
                    label="Teléfono Principal"
                    :disabled="$disabled"
                    wire:model="telefono_principal" />

            </div>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mt-4">

            <div class="md:col-span-4">

                <x-frk.components.label-input
                    label="Nombre Empresa"
                    :disabled="$disabled"
                    wire:model="nombre_empresa" />

            </div>

            <div>

                <x-frk.components.label-input
                    label="Teléfono Secundario"
                    :disabled="$disabled"
                    wire:model="telefono_secundario" />

            </div>

        </div>

    </div>

    {{-- CONTACTO --}}
    <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-envelope text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Información de Contacto
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <div class="md:col-span-3">

                <x-frk.components.label-input
                    label="Correo Electrónico"
                    :disabled="$disabled"
                    wire:model="correo_electronico" />

            </div>

            @if(!$isDisabledMinorista)

                <x-frk.components.label-input
                    label="CUI"
                    :disabled="$disabled"
                    wire:model="cui" />

            @endif

        </div>

    </div>

    {{-- DIRECCION --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-2">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-location-dot text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Dirección
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <x-frk.components.label-input
                label="Dirección"
                error="direccion_fisica"
                :disabled="$disabled"
                wire:model="direccion_fisica" />

            @if (!$isShow)

                <x-frk.components.select
                    label="Departamento"
                    error="direccion_departamento"
                    :disabled="$disabled"
                    wire:model.live="direccion_departamento">

                    @foreach ($this->departamentos as $data)

                        <option value="{{ $data->id }}">
                            {{ $data->nombre }}
                        </option>

                    @endforeach

                </x-frk.components.select>

                <x-frk.components.select
                    label="Municipio"
                    error="direccion_municipio"
                    :disabled="$disabled"
                    wire:model="direccion_municipio">

                    @foreach ($this->municipios as $data)

                        <option value="{{ $data->id }}">
                            {{ $data->nombre }}
                        </option>

                    @endforeach

                </x-frk.components.select>

            @else

                <x-frk.components.label-input
                    label="Departamento"
                    :disabled="$disabled"
                    wire:model="departamento" />

                <x-frk.components.label-input
                    label="Municipio"
                    :disabled="$disabled"
                    wire:model="municipio" />

            @endif

        </div>

    </div>

    {{-- CREDITO --}}
    @if (!$isDisabledMinorista)

        <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

            <div class="flex items-center gap-2 mb-1">

                <i class="fa-solid fa-credit-card text-orange-500"></i>

                <h3 class="font-semibold text-gray-700">
                    Información de Crédito
                </h3>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <x-frk.components.label-input
                    label="Latitud"
                    :disabled="$disabled"
                    wire:model="ubicacion_latitud" />

                <x-frk.components.label-input
                    label="Longitud"
                    :disabled="$disabled"
                    wire:model="ubicacion_longitud" />

                <x-frk.components.label-input
                    label="Límite Crédito (Q)"
                    error="limite_credito"
                    :disabled="$disabled"
                    wire:model="limite_credito" />

                <x-frk.components.label-input
                    label="Días Crédito"
                    :disabled="$disabled"
                    wire:model="dias_limite_credito" />

            </div>

        </div>

    @endif

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
