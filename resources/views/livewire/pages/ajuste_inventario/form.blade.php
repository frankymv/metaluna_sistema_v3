<div class="flex flex-col w-full space-y-5">

    {{-- INFORMACION GENERAL --}}
    <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-boxes-stacked text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Información del Ajuste
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <x-frk.components.label-input
                label="Ajuste Inventario No."
                error="ajuste_inventario_no"
                :disabled="$disabled"
                wire:model="ajuste_inventario_no" />

            <x-frk.components.date-picker
                error="fecha_ajuste_inventario"
                wire:model="fecha_ajuste_inventario"
                :disabled="$disabled"
                label="Fecha Ajuste Inventario" />

        </div>

    </div>

    {{-- PRODUCTO --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-2">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-box text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Producto
            </h3>

        </div>

        <x-frk.components.select
            label="Producto"
            error="producto_id"
            wire:model="producto_id">

            @foreach ($this->productos->productos as $dataa)

                <option
                    value="{{ $dataa->id }}"
                    wire:key="producto-{{ $dataa->id }}">

                    {{ $dataa->codigo }}
                    -
                    {{ $dataa->nombre }}
                    -
                    Existencia:
                    {{ $dataa->pivot->cantidad }}

                </option>

            @endforeach

        </x-frk.components.select>

    </div>

    {{-- AJUSTE --}}
    <div class="bg-orange-50 border border-orange-100 rounded-2xl p-5">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-arrow-right-arrow-left text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Detalle del Ajuste
            </h3>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <x-frk.components.select
                label="Tipo Ajuste"
                error="tipo_ajuste"
                wire:model="tipo_ajuste">

                @foreach ($this->tipos_ajustes as $data)

                    <option
                        value="{{ $data['valor'] }}"
                        wire:key="tipo-ajuste-{{ $data['valor'] }}">

                        {{ $data['nombre'] }}

                    </option>

                @endforeach

            </x-frk.components.select>

            <x-frk.components.label-input
                label="Cantidad a Ajustar"
                error="cantidad_traslado"
                :disabled="$disabled"
                wire:model="cantidad_traslado" />

        </div>

    </div>

    {{-- OBSERVACIONES --}}
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-2">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-comment text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Descripción
            </h3>

        </div>

        <x-frk.components.text-area
            label="Descripción"
            row="3"
            :disabled="$disabled"
            wire:model="descripcion" />

    </div>

</div>
