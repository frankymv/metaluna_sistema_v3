<x-frk.components.template-crud maxWidth="4xl">

    <x-slot:title>

        <div class="flex items-center gap-3">

            <div class="w-10 h-10 rounded-xl bg-orange-100 flex items-center justify-center">
                <i class="fa-solid fa-cart-plus text-orange-500"></i>
            </div>

            <div>
                <h2 class="text-xl font-bold text-gray-800">
                    Agregar Producto
                </h2>

                <p class="text-sm text-gray-500">
                    Configure cantidad y precio del producto seleccionado
                </p>
            </div>

        </div>

    </x-slot:title>

    <x-slot:body>

       <div class="flex flex-col w-full space-y-5">

    {{-- INFORMACION PRODUCTO --}}
    <div class="flex flex-col w-full bg-orange-50 border border-orange-100 rounded-2xl p-5">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-box text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Información del Producto
            </h3>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 w-full">

            <x-frk.components.label-input
                label="Código Producto"
                :disabled="$disabled_codigo_producto"
                wire:model="codigo_producto" />

            <x-frk.components.label-input
                label="Nombre Producto"
                :disabled="$disabled_nombre_producto"
                wire:model="nombre_producto" />

            <x-frk.components.label-input
                label="Nombre Venta"
                wire:model="nombre_venta" />

        </div>

    </div>

    {{-- PRECIOS Y EXISTENCIAS --}}
    <div class="flex flex-col w-full">

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-5 w-full items-stretch">

            <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm h-full">

                <div class="text-sm text-gray-500 mb-2">
                    Existencia Disponible
                </div>

                <div class="text-2xl font-bold text-orange-500">
                    {{ $existencia_producto }}
                </div>

                <div class="text-xs text-gray-400 mt-2">
                    unidades en inventario
                </div>

            </div>

            @if($isPie)

            <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm h-full">

                <x-frk.components.label-input-money
                    label="Precio Pie"
                    wire:model.live="precio_unitario" />

            </div>

            @endif

            <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm h-full">

                <x-frk.components.label-input-moneyy
                    label="Precio Final"
                    wire:model.live="precio_final"
                    @blur="
                        let v = parseFloat($event.target.value || 0);
                        $event.target.value = v.toFixed(2);
                    "
                />

            </div>
            <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm h-full">

                <x-frk.components.label-input-number
                    class="text-end"
                    label="Cantidad"
                    error="cantidad_producto"
                    :disabled="$disabled_cantidad_producto"
                    wire:model.live="cantidad_producto" />

            </div>

        </div>

    </div>

    {{-- DETALLE DE VENTA
    <div class="flex flex-col w-full bg-white border border-gray-200 rounded-2xl shadow-sm p-5">

        <div class="flex items-center gap-2 mb-1">

            <i class="fa-solid fa-calculator text-orange-500"></i>

            <h3 class="font-semibold text-gray-700">
                Detalle de Venta
            </h3>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 w-full">

            <x-frk.components.label-input-number
                class="text-end"
                label="Cantidad"
                error="cantidad_producto"
                :disabled="$disabled_cantidad_producto"
                wire:model.live="cantidad_producto" />

            <x-frk.components.label-input-moneyy
                label="Subtotal"
                error="subtotal_producto"
                :disabled="$disabled_subtotal_producto"
                wire:model.live="subtotal_producto"
                @blur="
                    let v = parseFloat($event.target.value || 0);
                    $event.target.value = v.toFixed(2);
                "
            />

        </div>

    </div> --}}

    {{-- RESUMEN --}}
    <div class="flex flex-col w-full bg-orange-400 rounded-2xl shadow-lg p-2 text-white">

        <div class="flex justify-between items-center">

            <span class="text-lg">
                Subtotal Calculado
            </span>

            <span class="text-3xl font-bold">
                Q {{ number_format((float)$subtotal_producto, 2) }}
            </span>

        </div>

    </div>

    {{-- ERRORES --}}
    <div class="flex w-full">
        <x-frk.components.error error="menor_existencia" />
    </div>

</div>

    </x-slot:body>

    <x-slot:footer>

        <div class="flex justify-end gap-3 w-full">

            <x-frk.components.button
                label="Cancelar"
                color="red"
                wire:click="cancelProductQuantity()" />

            <x-frk.components.button
                label="Agregar Producto"
                color="blue"
                wire:click="agregarDetalle({{ $this->id_producto }})" />

        </div>

    </x-slot:footer>

</x-frk.components.template-crud>
