<x-frk.components.template-crud>
    <x-slot:title>
        <x-frk.components.title label="Agregar Producto" />
    </x-slot>
    <x-slot:body>
        <div class="flex flex-wrap">
            <div class="flex w-full">
                <div class="flex w-full md:w-1/4">
                    <x-frk.components.label-input label="codigo_producto" :disabled="$disabled_codigo_producto" wire:model="codigo_producto" />
                </div>
                <div class="flex w-full md:w-3/4">
                    <x-frk.components.label-input label="nombre_producto" :disabled="$disabled_nombre_producto" wire:model="nombre_producto" />
                </div>
            </div>

            <div class="flex w-full">
                <div class="flex w-full md:w-1/4">
                    <x-frk.components.label-input label="existencia_producto" :disabled="$disabled_existencia_producto" wire:model="existencia_producto" />
                </div>


                <div class="flex w-full md:w-1/4">
                    <x-frk.components.label-input label="Precio: Q" :disabled="$disabled_precio_venta_producto" wire:model="precio_venta_producto" />
                </div>
                <div class="flex w-full md:w-1/3">
                    <x-frk.components.label-input label="Cantidad" :disabled="$disabled_cantidad_producto" wire:model="cantidad_producto" />
                </div>


                <div class="flex w-full md:w-1/3">
                    <x-frk.components.label-input label="Subtotal: Q" :disabled="$disabled_subtotal_producto" wire:model="subtotal_producto" />
                </div>
            </div>

    </x-slot>
    <x-slot:footer>
        <x-frk.buttons.save label="agregar {{$title}}" wire:click.prevent="addDetalle()" />
        <x-frk.components.button label="cancelar" wire:click.prevent="cancelProductQuantity()" />


        <x-frk.buttons.edit-icon-button  wire:click.prevent="updatePrice()" />

        @if ($disabledInputPasswordAdmin)
            <x-frk.buttons.unlock-icon-button wire:click.prevent="unlock()" />
            <x-frk.components.label-input  wire:model="usuario_edit" placeholder="Usuario" />
            <x-frk.components.label-input   wire:model="codigo_edit" placeholder="Contraseña" />
        @endif
    </x-slot>
    <div class="flex w-full md:w-1/3">
        <x-frk.components.error error="menor_existencia" />
    </div>

</x-frk.modal>

