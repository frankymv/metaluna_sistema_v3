<div>
    <x-frk.components.template-crud>
        <x-slot:title>
            <x-frk.components.title label="Detalle {{$title}}" />
        </x-slot>
        <x-slot:body>
            <div class="flex w-full flex-wrap m-4">
                <div class="flex w-full ">

                    <div class="flex w-full md:w-1/3">
                        <x-frk.components.label-input label="no credito" :disabled="$disabled" wire:model="no_credito" />
                    </div>

                    <div class="flex w-full md:w-1/3">
                        <x-frk.components.label-input label="fecha_credito" :disabled="$disabled" wire:model="fecha_credito" />
                    </div>
                    <div class="flex w-full md:w-1/3">
                        <x-frk.components.input-money  label="total credito" :disabled="$disabled" wire:model.live="total_credito" />
                    </div>

                </div>

                <div class="flex w-full ">


                    <div class="flex w-full md:w-1/3">
                        <x-frk.components.label-input label="no venta" error="nombres_cliente" :disabled="$disabled" wire:model="venta_id" />
                    </div>

                </div>


                <div class="flex w-full ">


                </div>

                <div class="flex w-full ">

                    <div class="flex w-full md:w-2/12">
                        <x-frk.components.label-input  label="Codigo" :disabled="$disabled" wire:model.live="cliente_id" />
                    </div>
                    <div class="flex w-full md:w-5/12">
                        <x-frk.components.label-input  label="Nombre" :disabled="$disabled" wire:model.live="nombres_cliente" />
                    </div>
                    <div class="flex w-full md:w-5/12">
                        <x-frk.components.label-input  label="Apellido" :disabled="$disabled" wire:model.live="apellidos_cliente" />
                    </div>
                </div>


                <div class="flex w-full ">

                    <div class="flex w-full">
                        <x-frk.components.label-input  label="observaciones" :disabled="$disabled" wire:model.live="observaciones_credito" />
                    </div>
                </div>





                @if ($isShow)
                    <div class="flex w-full ">
                        <x-frk.components.label-input label="Fecha creacion" :disabled="$disabled" wire:model="created_at" />
                        <x-frk.components.label-input label="Fecha Modificación" :disabled="$disabled" wire:model="updated_at" />
                    </div>
                @endif
            </div>

        </x-slot>
        <x-slot:footer>
            <x-frk.components.button label="cancelar" wire:click.prevent="cancel()" />
        </x-slot>
   </x-frk.components.template-crud>
</div>
