<div class="flex flex-col w-full space-y-5">

    {{-- INFORMACION PERSONAL --}}
    <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-id-card text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Información Personal
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-6 gap-4">

            <x-frk.components.label-input
                label="Código"
                :disabled="$disabled"
                wire:model="codigo" />

            <x-frk.components.label-input
                label="CUI"
                :disabled="$disabled"
                wire:model="cui" />

            <div class="md:col-span-2">

                <x-frk.components.label-input
                    label="Nombres"
                    :disabled="$disabled"
                    wire:model="nombres" />

            </div>

            <div class="md:col-span-2">

                <x-frk.components.label-input
                    label="Apellidos"
                    :disabled="$disabled"
                    wire:model="apellidos" />

            </div>

        </div>

    </div>

    {{-- DATOS GENERALES --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-2">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-user text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Datos Generales
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">

            <x-frk.components.date-picker
                wire:model="fecha_nacimiento"
                :disabled="$disabled"
                label="Fecha de Nacimiento" />

            <x-frk.components.label-input
                label="Teléfono Principal"
                :disabled="$disabled"
                wire:model="telefono_principal" />

            <x-frk.components.label-input
                label="Teléfono Secundario"
                :disabled="$disabled"
                wire:model="telefono_secundario" />

            <x-frk.components.label-input
                label="Tipo Sangre"
                :disabled="$disabled"
                wire:model="tipo_sangre" />

            <x-frk.components.label-input
                label="No. Licencia"
                :disabled="$disabled"
                wire:model="no_licencia" />

        </div>

    </div>

    {{-- CONTACTO Y TRABAJO --}}
    <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-briefcase text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Información Laboral
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <div class="md:col-span-2">

                <x-frk.components.label-input
                    label="Correo Electrónico"
                    :disabled="$disabled"
                    wire:model="email" />

            </div>

            <x-frk.components.date-picker
                wire:model="inicio_labores"
                :disabled="$disabled"
                label="Inicio de Labores" />

            <x-frk.components.date-picker
                wire:model="fin_labores"
                :disabled="$disabled"
                label="Fin de Labores" />

        </div>

    </div>

    {{-- DIRECCION --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-2">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-location-dot text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Dirección Domiciliar
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <div class="md:col-span-2">

                <x-frk.components.label-input
                    label="Dirección"
                    error="direccion_fisica"
                    :disabled="$disabled"
                    wire:model="direccion_fisica" />

            </div>

            <x-frk.components.select
                label="Departamento"
                error="direccion_departamento"
                :disabled="$disabled"
                wire:model.live="direccion_departamento">

                @foreach ($this->departamentos as $data)

                    <option value="{{ $data['id'] }}">
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

                    <option value="{{ $data['id'] }}">
                        {{ $data['nombre'] }}
                    </option>

                @endforeach

            </x-frk.components.select>

        </div>

    </div>

    {{-- ACCESO AL SISTEMA --}}
    <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-user-shield text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Acceso al Sistema
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <x-frk.components.label-input
                label="Usuario"
                :disabled="$disabled"
                wire:model="usuario" />

            <x-frk.components.label-input
                label="Password"
                :disabled="$disabled"
                wire:model="password" />

            <x-frk.components.select
                label="Rol"
                error="role_id"
                :disabled="$disabled"
                wire:model="role_id">

                @foreach ($this->roles as $data)

                    <option value="{{ $data['id'] }}">
                        {{ $data->name }}
                    </option>

                @endforeach

            </x-frk.components.select>

        </div>

    </div>

    {{-- SUCURSAL --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-2">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-building text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Sucursal Asignada
            </h3>

        </div>

        <x-frk.components.select
            label="Sucursal"
            error="sucursal"
            :disabled="$disabled"
            wire:model="sucursal_id">

            @foreach ($this->sucursales as $data)

                <option value="{{ $data->id }}">
                    {{ $data->nombre }}
                </option>

            @endforeach

        </x-frk.components.select>

    </div>

    {{-- ESTADO --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-2">

        <div class="flex items-center gap-2 mb-1">

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
