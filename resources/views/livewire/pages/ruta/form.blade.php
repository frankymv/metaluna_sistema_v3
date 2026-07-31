<div class="flex flex-col w-full space-y-5">

    {{-- INFORMACION GENERAL --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">

        <div class="flex items-center gap-2 mb-4">

            <i class="fa-solid fa-route text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Información de la Ruta
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <x-frk.components.label-input
                label="Código"
                :disabled="$disabled"
                wire:model="codigo" />

            <x-frk.components.label-input
                label="Nombre"
                :disabled="$disabled"
                wire:model="nombre" />

        </div>

        <div class="mt-4">

            <x-frk.components.text-area
                label="Descripción"
                row="2"
                :disabled="$disabled"
                wire:model="descripcion" />

        </div>

    </div>

    {{-- AGREGAR DETALLE --}}
    <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

        <div class="flex items-center gap-2 mb-4">

            <i class="fa-solid fa-map-location-dot text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Configuración de Ruta
            </h3>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">

            <div class="lg:col-span-3">

                <x-frk.components.select
                    label="Departamento"
                    error="direccion_departamento"
                    :disabled="$disabled"
                    wire:model.live="departamento_id">

                    @foreach ($this->departamentos as $data)

                        <option
                            value="{{ $data['id'] }}"
                            wire:key="departamento-{{ $data['id'] }}">

                            {{ $data['nombre'] }}

                        </option>

                    @endforeach

                </x-frk.components.select>

            </div>

            <div class="lg:col-span-3">

                <x-frk.components.select
                    label="Municipio"
                    error="direccion_municipio"
                    :disabled="$disabled"
                    wire:model.live="municipio_id">

                    @foreach ($this->municipios as $data)

                        <option
                            value="{{ $data['id'] }}"
                            wire:key="municipio-{{ $data['id'] }}">

                            {{ $data['nombre'] }}

                        </option>

                    @endforeach

                </x-frk.components.select>

            </div>

            <div class="lg:col-span-4">

                <x-frk.components.label-input
                    label="Observaciones"
                    :disabled="$disabled"
                    wire:model="observaciones" />

            </div>

            <div class="lg:col-span-2 flex items-end">

                <x-frk.components.button
                    color="blue"
                    label="Agregar"
                    wire:click.prevent="addDetalle()" />

            </div>

        </div>

    </div>

    {{-- DETALLE RUTA --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">

        <div class="px-5 py-3 bg-orange-400 text-white">

            <div class="flex justify-between items-center">

                <h3 class="font-semibold">
                    Detalle de Ruta
                </h3>

                <span class="bg-white/20 px-3 py-1 rounded-lg text-sm">

                    {{ count($inputs ?? []) }} municipios

                </span>

            </div>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-orange-100">

                    <tr>

                        <th class="px-4 py-3 text-left">
                            Departamento
                        </th>

                        <th class="px-4 py-3 text-left">
                            Municipio
                        </th>

                        <th class="px-4 py-3 text-left">
                            Observación
                        </th>

                        <th class="px-4 py-3 text-center">
                            Acción
                        </th>

                    </tr>

                </thead>

                @if ($inputs != null)

                    <tbody class="divide-y divide-gray-100">

                        @foreach($inputs as $key => $value)

                            <tr class="hover:bg-orange-50">

                                <td class="px-4 py-3 font-medium">

                                    {{ $nombreDepartamento[$value] }}

                                </td>

                                <td class="px-4 py-3">

                                    {{ $nombreMunicipio[$value] }}

                                </td>

                                <td class="px-4 py-3">

                                    {{ $observacionDetalle[$value] }}

                                </td>

                                <td class="px-4 py-3 text-center">

                                    <x-frk.components.button
                                        label="-"
                                        color="red"
                                        wire:click.prevent="removeDetalle({{ $value }})" />

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                @else

                    <tbody>

                        <tr>

                            <td
                                colspan="4"
                                class="text-center py-10 text-gray-500">

                                <i class="fa-solid fa-route text-4xl text-gray-300 mb-3"></i>

                                <p>
                                    No hay municipios agregados a la ruta
                                </p>

                            </td>

                        </tr>

                    </tbody>

                @endif

            </table>

        </div>

    </div>

</div>
