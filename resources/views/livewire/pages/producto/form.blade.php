<div class="flex w-full flex-wrap m-4">

    <div class="flex-row w-full">
        <x-frk.components.select label="Tipo" :disabled="$disabledTipo" error="tipo_id" wire:model.live="tipo_id">
            <option value="">-- Seleccione --</option>
            @foreach ($this->tipos as $data)
                <option value="{{ $data->id }}" @if(!$data->estado) disabled @endif wire:key="tipo-{{ $data->id }}">
                    {{ $data->nombre }}
                </option>
            @endforeach
        </x-frk.components.select>

        <x-frk.components.select label="Diseño" :disabled="$disabledDisenio" wire:model.live="disenio_id">
            <option value="">-- Seleccione --</option>
            @foreach ($this->disenios as $data)
                <option value="{{ $data->id }}" @if(!$data->estado) disabled @endif wire:key="forma-{{ $data->id }}">
                    {{ $data->nombre }}
                </option>
            @endforeach
        </x-frk.components.select>

        <x-frk.components.select label="Marca" :disabled="$disabledMarca" wire:model.live="marca_id">
            <option value="">-- Seleccione --</option>
            @foreach ($this->marcas as $data)
                <option value="{{ $data->id }}" @if(!$data->estado) disabled @endif wire:key="marca-{{ $data->id }}">
                    {{ $data->nombre }}
                </option>
            @endforeach
        </x-frk.components.select>

        <x-frk.components.select label="Material" :disabled="$disabledMaterial" wire:model.live="material_id">
            <option value="">-- Seleccione --</option>
            @foreach ($this->materiales as $data)
                <option value="{{ $data->id }}" @if(!$data->estado) disabled @endif wire:key="material-{{ $data->id }}">
                    {{ $data->nombre }}
                </option>
            @endforeach
        </x-frk.components.select>
    </div>

    <x-frk.components.divisor-line />

    {{-- ✅ CALIBRE --}}
    <div class="flex w-full gap-2 items-end">
        <div class="w-full md:w-1/4">
            <x-frk.components.toggle-calibre :disabled="$disabled" label="Usar Calibre" />
        </div>
        @if($usa_calibre)
            <div class="w-full md:w-3/4">
                <x-frk.components.label-input label="Calibre" :disabled="$disabled"
                    wire:model.live="calibre" placeholder="Ej: 12, 14, 18..." />
            </div>
        @endif
    </div>

    {{-- ✅ LONGITUD --}}
    <div class="flex w-full gap-2 items-end mt-2">
        <div class="w-full md:w-1/4">
            <x-frk.components.toggle-longitud :disabled="$disabled" label="Usar Longitud" />
        </div>

        @if($usa_longitud)
            <div class="w-full md:w-1/4">
                <x-frk.components.select label="Tipo Longitud" :disabled="$disabledLongitud" wire:model.live="tipo_longitud">
                    <option value="">--</option>
                    @foreach ($this->longitudes as $key => $data)
                        <option value="{{ $key }}">{{ $data }}</option>
                    @endforeach
                </x-frk.components.select>
            </div>

            <div class="w-full md:w-1/2">
                <x-frk.components.label-input label="Cantidad Longitud" :disabled="$disabled"
                    wire:model.live="longitud" placeholder="Ej: 6, 12, 20..." />
            </div>
        @endif
    </div>

    {{-- ✅ PESO --}}
    <div class="flex w-full gap-2 items-end mt-2">
        <div class="w-full md:w-1/4">
            <x-frk.components.toggle-peso :disabled="$disabled" label="Usar Peso" />
        </div>

        @if($usa_peso)
            <div class="w-full md:w-1/4">
                <x-frk.components.select label="Tipo Peso" :disabled="$disabledPeso" wire:model.live="tipo_peso">
                    <option value="">--</option>
                    @foreach ($this->pesos as $key => $data)
                        <option value="{{ $key }}">{{ $data }}</option>
                    @endforeach
                </x-frk.components.select>
            </div>

            <div class="w-full md:w-1/2">
                <x-frk.components.label-input label="Cantidad Peso" :disabled="$disabled"
                    wire:model.live="peso" placeholder="Ej: 10, 25..." />
            </div>
        @endif
    </div>

    {{-- ✅ DIAMETRO --}}
    <div class="flex w-full gap-2 items-end mt-2">
        <div class="w-full md:w-1/4">
            <x-frk.components.toggle-diametro :disabled="$disabled" label="Usar Diámetro" />
        </div>

        @if($usa_diametro)
            <div class="w-full md:w-1/4">
                <x-frk.components.select label="Tipo Diámetro" :disabled="$disabledDiametro" wire:model.live="tipo_diametro">
                    <option value="">--</option>
                    @foreach ($this->diametros as $key => $data)
                        <option value="{{ $key }}">{{ $data }}</option>
                    @endforeach
                </x-frk.components.select>
            </div>

            <div class="w-full md:w-1/2">
                <x-frk.components.label-input label="Cantidad Diámetro" :disabled="$disabled"
                    wire:model.live="diametro" placeholder="Ej: 1/2, 3/4, 2..." />
            </div>
        @endif
    </div>

    <x-frk.components.divisor-line />

            {{-- ✅ CODIGO Y NOMBRE AUTOMATICOS --}}
    <div class="flex w-full">
        <div class="w-full md:w-2/6">
            <x-frk.components.label-input label="Código" :disabled="true" wire:model="codigo" />
        </div>
        <div class="w-full md:w-2/6">
            <x-frk.components.label-input-moneyy label="Precio Unitario" wire:model.live="precio_unitario" @blur=" let v = parseFloat($event.target.value || 0); $event.target.value = v.toFixed(2);" />
        </div>
        <div class="w-full md:w-2/6">

            <x-frk.components.label-input-moneyy label="Precio Final" :disabled="true" wire:model.live="precio_final" @blur=" let v = parseFloat($event.target.value || 0); $event.target.value = v.toFixed(2);" />
        </div>
    </div>


    {{-- ✅ CODIGO Y NOMBRE AUTOMATICOS --}}
    <div class="flex w-full">

        <div class="w-full md:w-3/6">
            <x-frk.components.label-input label="Nombre" :disabled="true" wire:model="nombre" />
        </div>
        <div class="w-full md:w-3/6">
            <x-frk.components.label-input label="Nombre Venta" :disabled="$disabledNombreVenta" wire:model="nombre_venta" />
        </div>
    </div>




</div>
