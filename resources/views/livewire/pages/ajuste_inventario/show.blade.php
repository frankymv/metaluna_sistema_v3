<x-frk.components.template-crud>
    <x-slot:title>
        <x-frk.components.title label="Mostrar {{$title}}" />
    </x-slot>
    <x-slot:body>
       <div class="flex w-full flex-wrap m-4">
            <div class="flex w-full md:w-1/4">
                <x-frk.components.label-input label="Ajuste Inventario No."  error="ajuste_inventario_no" :disabled="$disabled" wire:model="ajuste_inventario_no" />
            </div>

            <div class="flex w-full md:w-1/4">
                <x-frk.components.date-picker  error="fecha_ajuste_inventario" wire:model="fecha_ajuste_inventario" label="Fecha Ajuste Bodega"/>
            </div>


                <div class="flex w-full md:w-1/4">
                    <x-frk.components.label-input label="Ajuste Inventario No."  error="ajuste_inventario_no" :disabled="$disabled" wire:model="nombreProducto" />
                </div>
                <div class="flex w-full md:w-1/4">
                    <x-frk.components.label-input label="Ajuste Inventario No."  error="ajuste_inventario_no" :disabled="$disabled" wire:model="cantidad_traslado" />
                </div>



    <div class="flex w-full">
        <x-frk.components.text-area label="descripcion" row="2" :disabled="$disabled" wire:model="descripcion" />
    </div>

</div>

    </x-slot>
    <x-slot:footer>

        <x-frk.components.button label="cancelar" wire:click="cancel()" />
    </x-slot>
</x-frk.modal>

