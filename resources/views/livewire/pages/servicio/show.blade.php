<div>
    <x-frk.components.template-crud>
        <x-slot:title>
            <x-frk.components.title label="Detalle {{$title}}" />
        </x-slot>
        <x-slot:body>

            <div class="flex w-full flex-wrap m-4">
                <div class="flex w-full md:w-1/4">
                    <x-frk.components.label-input label="no_servicio" error="no_servicio" :disabled="$disabled" wire:model="no_servicio" />
                </div>

                <div class="flex w-full md:w-1/4">

                </div>
                <div class="flex w-full md:w-1/4">
                    <x-frk.components.date-picker :disabled="$disabledInput" error="fecha_servicio" wire:model="fecha_servicio" label="Fecha Servicio"/>
                </div>
                <div class="flex w-full md:w-1/4">
                    <x-frk.components.input-money label="Costo del servicio" :disabled="$disabled" error="total_servicio"  wire:model="total_servicio" />
                </div>





                <div class="flex w-full">
                    <x-frk.components.label-input  label="Vehiculo" :disabled="$disabled" wire:model="vehiculo_id"/>
                </div>




                <div class="flex w-full">
                    <x-frk.components.text-area label="descripcion del servicio" error="descripcion" :disabled="$disabled" wire:model="descripcion" />
                </div>
                <div class="flex w-full">
                    <x-frk.components.label-input  label="Observaciones" :disabled="$disabled" wire:model="observaciones"/>
                </div>


            </div>

        </x-slot>
        <x-slot:footer>
            <x-frk.components.button label="cancelar" wire:click.prevent="cancel()" />
        </x-slot>
   </x-frk.components.template-crud>
</div>
