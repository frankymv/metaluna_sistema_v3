<x-frk.components.template-crud maxWidth=3xl>
    <x-slot:title>
        <x-frk.components.title label="Agregar Producto" />
    </x-slot>
    <x-slot:body>
        <div class="flex flex-wrap">
            <div class="flex w-full">
                <div class="flex flex-wrap w-4/6">
                    <x-frk.components.label-input label="codigo_producto" :disabled="$disabled_codigo_producto" wire:model="codigo_producto" />
                    <x-frk.components.label-input label="nombre_producto" :disabled="$disabled_nombre_producto" wire:model="nombre_producto" />
                    <x-frk.components.label-input label="nombre_venta" wire:model="nombre_venta" />
                </div>
                <div class="flex  flex-wrap w-2/6">
                    <x-frk.components.label-input-number class="text-end" label="existencia_producto" :disabled="$disabled_existencia_producto" wire:model="existencia_producto" />
                    @if($isPie)
                        <x-frk.components.label-input-money label="Precio Pie:" disabled="true"  wire:model.live="precio_unitario" />
                    @endif
                    <x-frk.components.label-input-money label="Precio Final:"  wire:model.live="precio_final" />
                </div>
            </div>
            <x-frk.components.divisor-line />

            <div class="flex w-full">
                <div class="flex flex-wrap w-4/6">
                    </div>
                <div class="flex flex-wrap w-2/6">

                        <x-frk.components.label-input-number class="text-end" label="Cantidad" error="cantidad_producto" :disabled="$disabled_cantidad_producto" wire:model.live="cantidad_producto" />

                        <x-frk.components.label-input-money label="Subtotal:" error="subtotal_producto" :disabled="$disabled_subtotal_producto" wire:model.live="subtotal_producto" />

                </div>
            </div>

        </div>
    </x-slot>
    <x-slot:footer>
        <x-frk.components.button label="agregar" color="blue" wire:click="agregarDetalle({{$this->id_producto}})" />


        <x-frk.components.button label="cancelar" wire:click="cancelProductQuantity()" />




    </x-slot>
    <div class="flex w-full md:w-1/3">
        <x-frk.components.error error="menor_existencia" />
    </div>

</x-frk.modal>

