<div class="flex flex-col w-full space-y-5">

    {{-- CLASIFICACION --}}
    <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

        <div class="flex items-center gap-2 mb-4">

            <i class="fa-solid fa-layer-group text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Clasificación del Producto
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

            <x-frk.components.select
                label="Tipo"
                :disabled="$disabledTipo"
                error="tipo_id"
                wire:model.live="tipo_id">

                <option value="">-- Seleccione --</option>

                @foreach ($this->tipos as $data)

                    <option
                        value="{{ $data->id }}"
                        @if(!$data->estado) disabled @endif
                        wire:key="tipo-{{ $data->id }}">

                        {{ $data->nombre }}

                    </option>

                @endforeach

            </x-frk.components.select>

            <x-frk.components.select
                label="Diseño"
                :disabled="$disabledDisenio"
                wire:model.live="disenio_id">

                <option value="">-- Seleccione --</option>

                @foreach ($this->disenios as $data)

                    <option
                        value="{{ $data->id }}"
                        @if(!$data->estado) disabled @endif
                        wire:key="disenio-{{ $data->id }}">

                        {{ $data->nombre }}

                    </option>

                @endforeach

            </x-frk.components.select>

            <x-frk.components.select
                label="Marca"
                :disabled="$disabledMarca"
                wire:model.live="marca_id">

                <option value="">-- Seleccione --</option>

                @foreach ($this->marcas as $data)

                    <option
                        value="{{ $data->id }}"
                        @if(!$data->estado) disabled @endif
                        wire:key="marca-{{ $data->id }}">

                        {{ $data->nombre }}

                    </option>

                @endforeach

            </x-frk.components.select>

            <x-frk.components.select
                label="Material"
                :disabled="$disabledMaterial"
                wire:model.live="material_id">

                <option value="">-- Seleccione --</option>

                @foreach ($this->materiales as $data)

                    <option
                        value="{{ $data->id }}"
                        @if(!$data->estado) disabled @endif
                        wire:key="material-{{ $data->id }}">

                        {{ $data->nombre }}

                    </option>

                @endforeach

            </x-frk.components.select>

        </div>

    </div>

 {{-- CARACTERISTICAS --}}
<div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">

    <div class="flex items-center gap-2 mb-4">

        <i class="fa-solid fa-ruler-combined text-orange-500"></i>

        <h3 class="font-semibold text-gray-700">
            Características del Producto
        </h3>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

        {{-- CALIBRE --}}
        <div class="bg-orange-50 border border-orange-100 rounded-xl p-4">

            <x-frk.components.toggle-calibre
                :disabled="$disabled"
                label="Usar Calibre" />

            @if($usa_calibre)

                <div class="mt-3">

                    <x-frk.components.label-input
                        label="Calibre"
                        :disabled="$disabled"
                        wire:model.live="calibre"
                        placeholder="Ej: 12, 14, 18..." />

                </div>

            @endif

        </div>

        {{-- LONGITUD --}}
        <div class="bg-orange-50 border border-orange-100 rounded-xl p-4">

            <x-frk.components.toggle-longitud
                :disabled="$disabled"
                label="Usar Longitud" />

            @if($usa_longitud)

                <div class="grid grid-cols-2 gap-3 mt-3">

                    <x-frk.components.select
                        label="Tipo"
                        :disabled="$disabledLongitud"
                        wire:model.live="tipo_longitud">

                        <option value="">--</option>

                        @foreach ($this->longitudes as $key => $data)

                            <option value="{{ $key }}">
                                {{ $data }}
                            </option>

                        @endforeach

                    </x-frk.components.select>

                    <x-frk.components.label-input
                        label="Cantidad"
                        :disabled="$disabled"
                        wire:model.live="longitud" />

                </div>

            @endif

        </div>

        {{-- PESO --}}
        <div class="bg-orange-50 border border-orange-100 rounded-xl p-4">

            <x-frk.components.toggle-peso
                :disabled="$disabled"
                label="Usar Peso" />

            @if($usa_peso)

                <div class="grid grid-cols-2 gap-3 mt-3">

                    <x-frk.components.select
                        label="Tipo"
                        :disabled="$disabledPeso"
                        wire:model.live="tipo_peso">

                        <option value="">--</option>

                        @foreach ($this->pesos as $key => $data)

                            <option value="{{ $key }}">
                                {{ $data }}
                            </option>

                        @endforeach

                    </x-frk.components.select>

                    <x-frk.components.label-input
                        label="Cantidad"
                        :disabled="$disabled"
                        wire:model.live="peso" />

                </div>

            @endif

        </div>

        {{-- DIAMETRO --}}
        <div class="bg-orange-50 border border-orange-100 rounded-xl p-4">

            <x-frk.components.toggle-diametro
                :disabled="$disabled"
                label="Usar Diámetro" />

            @if($usa_diametro)

                <div class="grid grid-cols-2 gap-3 mt-3">

                    <x-frk.components.select
                        label="Tipo"
                        :disabled="$disabledDiametro"
                        wire:model.live="tipo_diametro">

                        <option value="">--</option>

                        @foreach ($this->diametros as $key => $data)

                            <option value="{{ $key }}">
                                {{ $data }}
                            </option>

                        @endforeach

                    </x-frk.components.select>

                    <x-frk.components.label-input
                        label="Cantidad"
                        :disabled="$disabled"
                        wire:model.live="diametro" />

                </div>

            @endif

        </div>

    </div>

</div>

    {{-- PRECIOS --}}
    <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

        <div class="flex items-center gap-2 mb-4">

            <i class="fa-solid fa-money-bill-wave text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Información Comercial
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <x-frk.components.label-input
                label="Código"
                :disabled="true"
                wire:model="codigo" />

            <x-frk.components.label-input-moneyy
                label="Precio Unitario"
                wire:model.live="precio_unitario" />

            <x-frk.components.label-input-moneyy
                label="Precio Final"
                :disabled="true"
                wire:model.live="precio_final" />

        </div>

    </div>

    {{-- NOMBRES --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">

        <div class="flex items-center gap-2 mb-4">

            <i class="fa-solid fa-tags text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Descripción Comercial
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <x-frk.components.label-input
                label="Nombre"
                :disabled="true"
                wire:model="nombre" />

            <x-frk.components.label-input
                label="Nombre Venta"
                :disabled="$disabledNombreVenta"
                wire:model="nombre_venta" />

        </div>

    </div>

</div>
